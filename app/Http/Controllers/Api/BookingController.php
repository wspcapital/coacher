<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\{
    Controller
};

use App\Http\Requests\ParticipantRequest;

use App\Models\{
    Assets,
    BookingAssets,
    BookingDays,
    BookingParticipants,
    BookingSchedule, User,
    Booking,
    Traits\UserTrait,
    BookingTrainers
};

use Carbon\Carbon;

use Illuminate\Http\Request,
    Illuminate\Support\Facades\Auth,
    Illuminate\Support\Facades\Mail,
    Illuminate\Support\Facades\Input;

use App\Mail\Intranet\{
    SendBooks,
    RequestLogistics,
    SendAccount,
    SendDDP,
    RequestIna,
    NewAttachment
};

/**
 * Class BookingController
 * @package App\Http\Controllers\Api
 */
class BookingController extends Controller
{
    use UserTrait;

    /**
     * Return all participant
     *
     * @param $bookingId
     * @return mixed
     */
    public function getParticipants($bookingId)
    {
        $trainers = [];

        BookingTrainers::where('booking_id', $bookingId)->each(function ($item) use (&$trainers) {
            $trainers[$item->id]['value'] = $item->id;
            $trainers[$item->id]['text'] = $item->user->full_name;
        });

        $bookingParticipants = BookingParticipants::where('booking_id', $bookingId)->with('user')
            ->get();
        //TODO: check and test
        $bookingParticipants = $bookingParticipants->each(function ($participant) use ($bookingId) {
            $participant->user->vcoaches = $participant->user->getBookingVCoaches($bookingId);
            $participant->user->sessions = $participant->user->getBookingSessions($bookingId);
            if ($participant->bookingTrainer != null) {
                $participant->user->trainerId = $participant->bookingTrainer->id;
                $participant->user->trainerName = $participant->bookingTrainer->user->full_name;
            }

            if (empty($participant->data()->ina)) {
                $participant->data()->ina->status = '';
            }

            if (empty($participant->data()->ddp)) {
                $participant->data()->ddp->status = '';
            }

            if (empty($participant->data()->account_sent)) {
                $participant->data()->account_sent = '';
            }

            if (empty($participant->data()->blockNotify)) {
                $participant->data()->blockNotify = 0;
            }
        });

        return [
            'participants' => $bookingParticipants,
            'trainers' => $trainers
        ];
    }

    /**
     * @param ParticipantRequest $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function addParticipant(ParticipantRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $participant = $this->saveParticipant($request->all(), $user->id);
        } else {
            $newUser = $this->createUser($request->all());   // create user
            $newUser->attachRole(4);
            $participant = $this->saveParticipant($request->all(), $newUser->id);
        }

        $participant->user->sessions = $participant->user->getSessions();
        $participant->user->vcoaches = $participant->user->getVCoaches();

        return $participant;
    }

    /**
     * Add booking participant
     *
     * @param array $data
     * @param integer $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function saveParticipant($data, $userId)
    {
        return BookingParticipants::create([
            'booking_id' => $data['booking_id'],
            'user_id' => $userId,
            'booking_trainers_id' => '0',
            'type' => 'BookingSheet'
        ]);
    }

    /**
     * Delete participant booking
     *
     * @param Request $request
     * @return mixed
     */
    public function deleteParticipant(Request $request)
    {
        if ($id = BookingParticipants::where('booking_id', $request->booking_id)
            ->where('user_id', $request->user_id)
            ->delete()
        ) {
            return response()->success('Participant removed', $id);
        } else {
            return response()->error('Participant not deleted');
        }
    }

    /**
     * Delete booking trainer
     * @param BookingTrainers $bookingTrainer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteTrainer(BookingTrainers $bookingTrainer)
    {
        if ($bookingTrainer->delete()) {
            return response()->success('Trainer deleted', $bookingTrainer->user_id);
        } else {
            return response()->error('Error delete trainer', 503);
        }
    }

    /**
     * Save participant trainer
     * @param Request $request
     * @return bool
     */
    public function saveParticipantTrainer(Request $request)
    {
        if (BookingParticipants::findOrFail($request->participant_id)->update([
            'booking_trainers_id' => $request->trainer_id
        ])
        ) {
            return response()->success('Save Trainer');
        } else {
            return response()->error('Error saving trainer', 500);
        }
    }

    /**
     * Save participant block notify
     * @param Request $request
     * @return bool
     */
    public function blockNotify()
    {
        if ($participant = BookingParticipants::findOrFail(Input::get('participant_id'))) {
            $participant->data()->blockNotify = Input::get('block_notify') == 'true' ? 1 : 0 ;
            $participant->save();
            return response()->success('Save Block Notify', $participant->data()->blockNotify);
        } else {
            return response()->error('Error saving trainer', 500);
        }
    }

    /**
     * Get participant INA Share Hash
     * @param $id
     * @return string
     */
    public function inaShareHash($id)
    {
        if ($participant = BookingParticipants::findOrFail($id)) {
            return response()->success('Current INA share hash', $participant->share_hash);
        } else {
            return response()->error('Error, participant is not find', 500);
        }
    }

    public function saveParticipantVCoach(Request $request)
    {
        return Auth::user()->addVCoaches($request);
    }

    public function saveParticipantSession(Request $request)
    {
        return Auth::user()->addSessions($request);
    }

    /**
     * Curriculum events
     *
     * @param $bookingId
     * @return array
     */
    public function getEvents($bookingId)
    {
        $events = [];
        BookingDays::where('booking_id', $bookingId)->each(function ($event) use (&$events) {
            $events[] = [
                'start' => $event->booking_date . " " . $event->time_start,
                'end' => $event->booking_date . " " . $event->time_end,
                'title' => $event->title,
                'subtitle' => ($event->subtitle != null) ? $event->subtitle : "",
                'description' => $event->lesson_id,
                'id' => $event->id,
                'color' => $event->color ?? '#EBF8A4'
            ];
        });

        return $events;
    }

    public function deleteEvent(Request $request)
    {
        BookingDays::findOrFail($request->id)->delete();
    }

    public function uploadFile(Request $request)
    {
        $bookingAssets = $this->uploadBookingFile($request->all());
        $trainers = BookingTrainers::where('booking_id', $bookingAssets->booking_id)->with('user')->get();
        foreach ($trainers as $trainer) {
            Mail::to($trainer->user)->send(new NewAttachment($bookingAssets));
        }

        return $bookingAssets;
    }

    public function uploadDdpFile(Request $request)
    {
        $uploadParams = $this->saveDdpFile($request->all());
        $ddpAssets = Assets::findOrFail($uploadParams['asset_id']);
        $ddpPath = $ddpAssets->getMedia()[0]->getUrl();
        $participant = BookingParticipants::find($request->id);
        $participant->data()->ddp->status = 'uploaded';
        $participant->data()->ddp->asset_id = $uploadParams['asset_id'];
        $participant->data()->ddp->file_name = $uploadParams['fileName'];
        $participant->data()->ddp->url = $ddpPath;
        $participant->data()->ddp->notice_sent = 0;
        $participant->save();

        return response()->success('DDP file success uploaded', $participant->data()->ddp);
    }

    public function getBookingFile(Request $request)
    {
        return response()->success(
            'Booking files',
            BookingAssets::where('booking_id', $request->bookingId)->with('assets.media')->get()
        );
    }

    public function deleteBookingFile($id)
    {
        if (Assets::deleteFile($id)) {
            return response()->success('File removed');
        } else {
            return response()->error('Failed to delete file');
        }
    }

    public function deleteAllBookingFile(Request $request)
    {
        foreach (BookingAssets::where('booking_id', $request->bookingId)->get() as $bookingAssets) {
            $bookingAssets->assets->delete();
        }
    }

    public function sendIna($id, Request $request)
    {
        if ($id == 'all') {
            $participants = [];
            foreach (BookingParticipants::where('booking_id', $request->booking_id)->get() as $participant) {
                $participant->share_hash = str_random(40);
                $blockNotify = !empty($participant->data()->blockNotify) && $participant->data()->blockNotify == '1'
                    ? true : false;
                if (!$blockNotify) {
                    $participant->data()->ina->status = 'sent';
                    $to = $participant->user->email;
                    Mail::to($to)
                        ->send(new RequestIna($participant));
                } else {
                    $participant->data()->ina->status = '';
                }
                $participant->save();
                $participant->data()->ina->share_hash = $participant->share_hash;
                $participants[$participant->id] = $participant->data()->ina;
            }
            return response()->json($participants);
        } else {
            $participant = BookingParticipants::findOrFail($id);
            $participant->share_hash = str_random(40);
            $blockNotify = !empty($participant->data()->blockNotify) && $participant->data()->blockNotify == '1'
                ? true : false;
            if (!$blockNotify) {
                $participant->data()->ina->status = 'sent';
                $to = $participant->user->email;
                Mail::to($to)
                    ->send(new RequestIna($participant));
            }
            $participant->save();
            $participant->data()->ina->share_hash = $participant->share_hash;
            return response()->success('Send INA', $participant->data()->ina);
        }
        return response()->error('Error booking find');
    }

    public function sendAccount($id, Request $request)
    {
        if ($id == 'all') {
            $participants = [];
            foreach (BookingParticipants::where('booking_id', $request->booking_id)->get() as $participant) {
                $blockNotify = !empty($participant->data()->blockNotify) && $participant->data()->blockNotify == '1'
                    ? true : false;
                if (!$blockNotify) {
                    $participant->data()->account_sent = '1';
                    $participant->save();

                    if (!empty($participant->user)) {
                        $to = $participant->user->email;
                        Mail::to($to)
                            ->send(new SendAccount($participant->user));
                        $participant->user->save();
                        $participants[$participant->id] = $participant->data()->account_sent;
                    }
                }
            }
            return response()->success('Send user account', $participants);//response()->json($participants);
        } else {
            $participant = BookingParticipants::findOrFail($id);
            $blockNotify = !empty($participant->data()->blockNotify) && $participant->data()->blockNotify == '1'
                ? true : false;
            if (!$blockNotify) {
                $participant->data()->account_sent = '1';
                $participant->save();

                $to = $participant->user->email;
                Mail::to($to)
                    ->send(new SendAccount($participant->user));
            } else {
                $participant->data()->account_sent = '0';
            }
            return response()->success('Send user account', $participant->data()->account_sent);
        }
        return response()->error('Error booking find');
    }

    public function sendLogistics(Request $request)
    {
        if ($booking = Booking::findOrFail($request->booking_id)) {
            do {
                $share_hash = str_random(40);
            } while (Booking::where('share_hash', $share_hash)->first());
            $booking->share_hash = $share_hash;
            $booking->data()->logistics->status = 'sent';
            $booking->save();
            if ($to = $booking->client_email) {
                Mail::to($to)
                    ->send(new RequestLogistics($booking));
            }
            $booking->data()->logistics->share_hash = url('docs/logistics/') . '/' . $share_hash;
            return response()->success('Logistics sent sucessfully', $booking->data()->logistics);
        }
        return response()->error('Error booking find');
    }

    public function sendBooks(Request $request)
    {
        if ($booking = Booking::findOrFail($request->booking_id)) {
            $booking->data->bookssent = 1;
            $to = ['admin@pinper.com', 'sbaculi@pinper.com', empty($booking->rm->email) ? '' : $booking->rm->email];
            Mail::to($to)
                ->send(new SendBooks($booking));
            $booking->save();
            return response()->success('Booking sent sucessfully', $booking->data());
        }
        return response()->error('Error booking find');
    }

    public function sendDDP($id, Request $request)
    {
        if ($id == 'all') {
            $participants = [];
            foreach (BookingParticipants::where('booking_id', $request->booking_id)->get() as $participant) {
                $blockNotify = !empty($participant->data()->blockNotify) && $participant->data()->blockNotify == '1'
                    ? true : false;
                if ($participant->data()->ddp->status == 'uploaded' && !$blockNotify) {
                    $participant->data()->ddp->notice_sent = '1';
                    $to = $participant->user->email;
                    Mail::to($to)
                        ->send(new SendDDP($participant->user));
                    $participant->save();
                    $participants[$participant->id] = $participant->data()->ddp;
                } else {
                    $participant->data()->ddp->notice_sent = '0';
                }
                $participants[$participant->id] = $participant->data()->ddp;
            }
            return response()->success('Send DDP', $participants);
        } else {
            $participant = BookingParticipants::findOrFail($id);
            $blockNotify = !empty($participant->data()->blockNotify) && $participant->data()->blockNotify == '1'
                ? true : false;
            if ($participant->data()->ddp->status == 'uploaded' && !$blockNotify) {
                $participant->data()->ddp->notice_sent = '1';
                $to = $participant->user->email;
                Mail::to($to)
                    ->send(new SendDDP($participant->user));
                $participant->save();
            }
            return response()->success('Send DDP', $participant->data()->ddp);
        }
        return response()->error('Error booking find');
    }

    public function getSchedule($bookingId, $currentDate)
    {
        $bookingDate = Carbon::parse($currentDate)->format('Y-m-d');
        $schedule = BookingSchedule::where('booking_id', $bookingId)->where('booking_day', $bookingDate)->first();
        $start = $schedule->start ?? '1:00';
        $end = $schedule->end ?? '00:00';
        return response()->success('Start and end day', [
            'start' => Carbon::parse($start)->format('H:i A'),
            'end' => Carbon::parse($end)->format('H:i A')
        ]);
    }

    public function saveSchedule()
    {
        $data = Input::get('data');

       // dd($data);
        $bookingDate = Carbon::parse($data['current_day'])->format('Y-m-d');
        $start = isset($data['start']) ? Carbon::parse($data['start'])->format('H:i') : null;

        $end = isset($data['end']) ? Carbon::parse($data['end'])->format('H:i') : null;
        $schedule = BookingSchedule::where('booking_id', $data['bookingId'])
            ->where('booking_day', $bookingDate)
            ->first();
        if ($schedule == null) {
            BookingSchedule::create([
                'booking_id' => $data['bookingId'],
                'booking_day' => $bookingDate,
                'start' => $start,
                'end' => $end
            ]);
        } else {
            $schedule->update([
                'start' => $start,
                'end' => $end
            ]);
        }
    }
}
