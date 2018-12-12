<?php

namespace App\Http\Controllers;

use App\Models\User,
    Illuminate\Http\Request,
    MercurySeries\Flashy\Flashy,
    Illuminate\Support\Facades\Auth,
    App\Models\Payment,
    App\Models\PaymentItems,
    Illuminate\Support\Facades\Config, App\Http\Controllers\Traits\PaymentsTrait,
    Illuminate\Support\Facades\Session,
    App\Models\Coupon;

class PaymentsController extends Controller
{
    use PaymentsTrait;

    public function getConfig(Request $request)
    {
        return json_encode($response = [
            'type' => $this->getPaymentTypes($request->type),
           // 'type' => $this->getPaymentTypes('session'),
            'currency' => $this->getPaymentCurrencies(),
            'key' => $this->getPublicKey(),
            'user' => User::where('id', Auth::user()->id)->first()
        ]);
    }

    public function getVCoachConfig()
    {
        return [
            'payments' => $this->getPaymentAllType(),
            'currency' => $this->getPaymentCurrencies()
        ];
    }

    public function postCharge(Request $request)
    {
       // return $this->chargeError('Wrong total amount. Please try again.');
      //  dd($request->all());
        /*print_r(Request::all());
        exit();
        return redirect()->back();*/
        // Set Stripe authentication API key
        \Stripe\Stripe::setApiKey($this->getSecretKey());

        // region Validation

        if (Auth::user()->id != $request->user_id) {
            return $this->chargeError('User account has been changed. Please try again.');
        }

        $currency = strtolower(strval($request->currency));
        if (!in_array($currency, $this->getCurrenciesList())) {
            return $this->chargeError('Unknown order currency. Please try again.');
        }

        $coupon = null;
        if ($request->coupon) {
            /** @var Coupon $coupon */
            $coupon = Coupon::where('code', $request->coupon)->first();
            //dd($coupon);
            if (!$coupon || !$coupon->checkAvailable()) {
                return $this->chargeError('Coupon is invalid. Please try again.');
            }
        }

        // Get the token ID (for credit card details) submitted by the form
        $token_id = $request->stripeToken;
        if (!$token_id) {
            return $this->chargeError('Stripe token not provided. Please try again.');
        }

        // Check token details for authenticity
        try {
            $token = \Stripe\Token::retrieve($token_id);
        } catch (Exception $e) {
            // Catch all Stripe errors
            return $this->chargeError($e->getMessage());
        }
        if (!object_get($token, 'email') || $token->email != Auth::user()->email) {
            return $this->chargeError('Stripe token is unauthentic. Please try again.');
        }

        $items = $request->items;
        if (!is_array($items) || count($items) < 1) {
            return $this->chargeError('No order items. Please try again.');
        }

        $types = Config::get('payment.types');
        $amount = 0;
        $descriptions = [];
        $paymentItems = [];
        $vcoaches_qty = $sessions_qty = 0;

        foreach ($items as $item) {
            if (!is_array($item)) {
                return $this->chargeError('Order item error. Please try again.');
            }

            $type = strval(array_get($item, 'type'));
            if (!in_array($type, array_keys($types))) {
                return $this->chargeError('Unknown order item type. Please try again.');
            }

            $qty = strval(array_get($item, 'qty'));
            if (!preg_match('/^\d+$/', $qty)) {
                return $this->chargeError('Wrong order item quantity. Please try again.');
            }
            $qty = intval($qty);
            // Skip null items
            if ($qty < 1) {
                continue;
            }

            $price = array_get($types[$type], 'price.' . $currency, 0);
            $amount += $price * $qty;
            $descriptions[] = trans_choice($types[$type]['description'], $qty, compact('qty'));

            // Create payment item model
            $paymentItem = new PaymentItems();
            $paymentItem->type = $type;
            $paymentItem->price = $price;
            $paymentItem->qty = $qty;
            $paymentItem->vcoaches = array_get($types[$type], 'items.vcoaches', 0);
            $paymentItem->sessions = array_get($types[$type], 'items.sessions', 0);
            $paymentItems[] = $paymentItem;

            $vcoaches_qty += $paymentItem->vcoaches * $qty;
            $sessions_qty += $paymentItem->sessions * $qty;
        }

        // Apply coupon
        if ($coupon) {
            $coupons = Config::get('payment.coupons');
            switch ($coupon->type) {
                case 'discount':
                    $discount = $coupon->discount ?: 0;
                    $amount -= intval(floor($amount * $discount / 100));
                    $extraDescription = trans_choice($coupons[$coupon->type]['description'], 0, compact('discount'));
                    break;
                case 'free':
                    $couponDescriptions = [];
                    if ($coupon->vcoaches) {
                        $qty = $coupon->vcoaches;
                        $vcoaches_qty += $qty;
                        $couponDescriptions[] = trans_choice($types['video']['description'], $qty, compact('qty'));
                    }
                    if ($coupon->sessions) {
                        $qty = $coupon->sessions;
                        $sessions_qty += $qty;
                        $couponDescriptions[] = trans_choice($types['session']['description'], $qty, compact('qty'));
                    }
                    $text = count($couponDescriptions) ? implode(' and ', $couponDescriptions) : 'nothing';
                    $extraDescription = trans_choice($coupons[$coupon->type]['description'], 0, compact('text'));
                    break;
                default:
                    return $this->chargeError('Unknown coupon type. Please try again.');
                    break;
            }
        }

        $description = $this->makeDescription($descriptions, isset($extraDescription) ? $extraDescription : null);

        if ($amount != $request->amount || $amount <= 0) {
            echo $amount . "<br>";
            echo $request->amount . ' => req <br>';
            return $this->chargeError('Wrong total amount. Please try again.');
        }

        // endregion Validation

        // Create payment and store it in DB
        $payment = new Payment();
        $payment->user_id = Auth::user()->id;
        $payment->amount = $amount;
        $payment->currency = $currency;
        $payment->vcoaches_qty = $vcoaches_qty;
        $payment->sessions_qty = $sessions_qty;
        $payment->description = $description;
        $payment->coupon_id = $coupon ? $coupon->getKey() : null;
        $payment->save();
        // Store payment items in DB
        $payment->items()->saveMany($paymentItems);

        // Create the charge on Stripe's servers - this will charge the user's card
        try {
            $data = [
                'amount' => $amount, // amount in cents, again
                'currency' => $currency,
                'source' => $token_id,
                'description' => $description,
                'metadata' => [
                    'payment_id' => $payment->getKey(),
                    'user_id' => $payment->user_id,
                ],
            ];
            if ($coupon) {
                $data['metadata']['coupon'] = $coupon->code;
            }
            $charge = \Stripe\Charge::create($data);
        } catch (Exception $e) {
            // Catch all Stripe errors
            $payment->status = 'failed';
            $payment->failure_message = $e->getMessage();
            $payment->save();
            return $this->chargeError($e->getMessage());
        }

        // Update payment data
        $keys = [
            'status' => 'status',
            'failure_code' => 'failure_code',
            'failure_message' => 'failure_message',
        ];
        foreach ($keys as $attribute => $key) {
            $value = object_get($charge, $key);
            // Save value if it isn't empty (and if it is a valid status for 'status' field)
            if ($value && ($attribute != 'status' || in_array($value, ['succeeded', 'failed']))) {
                $payment->{$attribute} = $value;
            }
        }
        $payment->save();

        // Check status
        if (object_get($charge, 'status') != 'succeeded') {
            return $this->chargeError(object_get($charge, 'failure_message') ?: 'Something went wrong.
             Please contact us for help.');
        }

       /* // Add vcoaches and sessions to user
        Auth::user()->vcoaches += $vcoaches_qty;
        Auth::user()->sessions += $sessions_qty;
        Auth::user()->save();*/

       // отправка  письма  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        // Deactivate coupon
        if ($coupon) {
            $coupon->deactivate();
        }

        Session::flash('success', "Congratulations! You've successfully bought " . e($description));

        return redirect()->back();
    }
}
