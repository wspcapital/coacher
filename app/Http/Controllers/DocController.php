<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\Models\BookingParticipants,
    MercurySeries\Flashy\Flashy,
    App\Models\Booking,
    App\Models\User,
    App\Models\Traits\UserTrait,
    App\Mail\Doc\InaSubmitted,
    App\Mail\Doc\LogisticsSubmitted,
    App\Http\Controllers\Traits\CustomFunction,
    Illuminate\Support\Facades\Mail,
    Carbon\Carbon;

class DocController extends Controller
{
    use UserTrait, CustomFunction;

    /**
     * @param  $share_hash
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIna($share_hash)
    {
        if ($participant =  BookingParticipants::where('share_hash', '=', $share_hash)
            ->with(['booking', 'user'])->first()) {
            $participant->data = json_decode($participant->data);
            return view('docs.ina')->with(['p'=>$participant]);
        }
        abort(404, 'Page not found.');
    }

    /**
     * Save participant Ina
     *
     * @param Request $request
     * @param string $share_hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveIna($share_hash, Request $request)
    {
        if ($participant =  BookingParticipants::where('share_hash', '=', $share_hash)
            ->with(['booking', 'user'])->first()) {
                $participant->data->ina = $request->except('_token');
                $participant->save();

                Mail::to($participant->user->email)
                    ->send(new InaSubmitted($participant));

                return redirect()->back()->with('success', trans('doc/ina.create_message'));
        }
        abort(404, 'Page not found.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogistics($share_hash)
    {
        if ($booking =  Booking::where('share_hash', '=', $share_hash)
            ->with(['bookingParticipants.user', 'bookingTrainers.user', 'BookingDays', 'BookingSchedules'])->first()) {
            return view('docs.logistics')->with(['booking'=>$booking,
                'country'=>$this->country(), 'state' => $this->state()]);
        }
        abort(404, 'Page not found.');
    }

    /**
     * Save Logistics
     *
     * @param Request $request
     * @param string $share_hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveLogistics($share_hash, Request $request)
    {
        if ($booking =  Booking::where('share_hash', '=', $share_hash)->first()) {
            if (is_array($request->data['logistics'])) {
                foreach ($request->data['logistics'] as $k => $v) {
                    $booking->data()->logistics->{$k} = $v;
                }
            }
            $booking->data()->logistics->status = 'received';
            foreach ($request->only([
                'location_name',
                'location_address',
                'location_city',
                'location_state',
                'location_zip',
                'location_country',
                'start_date',
                'end_date'
            ]) as $k => $v) {
                if ($k == 'start_date' || $k == 'end_date') {
                    $booking->{$k} = Carbon::parse($v)->format('Y-m-d');
                } else {
                    $booking->{$k} = $v;
                }
            }

            $booking->save();

            if (!empty($request->part)) {
                foreach ($request->part as $userId => $user) {
                    if (preg_match('/^newPart_*[0-9]/', $userId)) {
                        if ($userPart = User::where('email', $user['email'])->first()) {
                            $userPart->first_name = $user['first_name'];
                            $userPart->last_name = $user['last_name'];
                            $userPart->save();
                        } else {
                            $passtext = $this->generatePassword(8);
                            $userPart = User::create([
                                'first_name' => $user['first_name'],
                                'last_name' => $user['first_name'],
                                'email' => $user['email'],
                                'passtext' => $passtext,
                                'password' => bcrypt($passtext)
                            ]);
                        }
                        BookingParticipants::create([
                            'booking_id'=>$booking->id,
                            'user_id'=>$userPart->id,
                            'type'=>'BookingSheet'
                        ]);
                    }
                }
            }


            Mail::to([$booking->rm->email, $booking->booker->email])
                ->send(new LogisticsSubmitted($booking));

            return redirect()->back()->with('success', trans('doc/logistics.create_message'));
        }
        abort(404, 'Page not found.');
    }
}
