<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking,
    App\Models\BookingParticipants,
    Illuminate\Http\Request,
    App\Http\Controllers\Controller,
    Illuminate\Support\Facades\Mail,
    App\Mail\Intranet\BulkNotify;

class BulkController extends Controller
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllBulks()
    {
        return Booking::orderBy('start_date', 'desc')
                                ->where('type', '=', 'Bulk')
                                ->with('rm')
                                ->paginate(20);
    }

    /**
     * Return all bulk participant
     *
     * @param Request $request
     * @return mixed
     */
    public function getBulkParticipants(Request $request)
    {
        $participants = BookingParticipants::where('booking_id', $request->id)->with('user')->with('orders')->get();

        foreach ($participants as $participant) {
            $participant->user->vcoaches = $participant->user->getBookingVCoaches($request->id);
            $participant->user->sessions = $participant->user->getBookingSessions($request->id);
            /* foreach ($participant->credits as $credit) {
                 if ($credit->type == 'Vcoach') {
                     $participants->Vcoach = $credit->amount;
                 } elseif ($credit->type == 'Session') {
                     $participants->Session = $credit->amount;
                 }
             }*/
        }

        return [
            'participants' => $participants
        ];
    }

    public function deleteBulk(Request $request)
    {
        dd($request->all());
    }

    public function searchBulks(Request $request)
    {
        return Booking::where('type', 'Bulk')->search(trim($request->q))->orderBy('start_date', 'desc')->paginate(20);
    }

    public function sendNotify($id, Request $request)
    {
        if ($id == 'all') {
            $participants = [];
            foreach (BookingParticipants::where('booking_id', $request->booking_id)->get() as $participant) {
                $participant->data('notify', 'notified');
                $participant->save();
                $participant->user->data('account_sent', '1');
                $participant->user->save();
                $to = $participant->user->email;
                Mail::to($to)
                    ->send(new BulkNotify($participant->user));
                $participants[$participant->id] = $participant->data()->account_sent;
            }
            return json_encode($participants);
        } elseif ($id == 'new') {
            $participants = [];
            foreach (BookingParticipants::where('booking_id', $request->booking_id)->get() as $participant) {
                $participant->data('notify', 'notified');
                $participant->save();
                $participant->user->data('account_sent', '1');
                $participant->user->save();
                if (empty($participant->user->passtext)) {
                    $to = $participant->user->email;
                    Mail::to($to)
                        ->send(new BulkNotify($participant->user));
                    $participants[$participant->id] = $participant->data()->account_sent;
                }
            }
            return json_encode($participants);
        } else {
            $participant = BookingParticipants::find($id);
            $participant->data('notify', 'notified');
            $participant->save();
            $participant->user->data('account_sent', '1');
            $participant->user->save();
            $to = $participant->user->email;
            Mail::to($to)
                ->send(new BulkNotify($participant->user));

            return json_encode($participant->data()->account_sent);
        }
    }
}
