<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Config,
    Illuminate\Support\Facades\Session;

/**
 * Trait Payments
 */
trait PaymentsTrait
{
    public function getPaymentCurrencies()
    {
        return json_encode(Config::get('payment.currencies'));
    }

    public function getCurrenciesList()
    {
        return array_keys(Config::get('payment.currencies'));
    }

    public function getPaymentTypes($type = 'session')
    {
        $types = Config::get('payment.types.' . strtolower($type));

        return json_encode($types);
    }

    public function getPaymentAllType()
    {
        return Config::get('payment.types');
    }

    public function getPublicKey()
    {
        return Config::get('services.stripe.key');
    }

    public function getSecretKey()
    {
        return Config::get('services.stripe.secret');
    }

    protected function chargeError($message)
    {
        Session::flash('error', $message);

        return redirect()->back();
    }


    protected function makeDescription(array $descriptions, $extraDescription = null)
    {
        $glue = count($descriptions) > 2 ? ', ' : ' and ';

        if (count($descriptions) > 3) {
            $description = implode($glue, array_slice($descriptions, 0, 3)) . ' and others.';
        } else {
            $description = implode($glue, $descriptions);
        }

        // Adds description for coupon
        if ($extraDescription) {
            $description .= ' ' . $extraDescription;
        }

        return $description;
    }
}
