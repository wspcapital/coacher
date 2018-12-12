<?php

namespace App\Http\Controllers\Intranet;

use App\Models\{
    Assets, BookingAssets, BookingSchedule, BookingTrainers, Booking, BookingDays, Lesson
};
use App\Http\Requests\{
    UpdateBookingRequest,
    BookingRequest
};
use Illuminate\Support\Facades\{
    Auth, DB, Input, View
};
use App\Http\Controllers\Traits\CustomFunction,
    App\Models\Traits\LaratrustCustomTrait,
    Illuminate\Http\Request,
    MercurySeries\Flashy\Flashy,
    App\Http\Controllers\Controller,
    Carbon\Carbon;

/**
 * Class BookingController
 * @package App\Http\Controllers\Intranet
 */
class BookingController extends Controller
{
    use LaratrustCustomTrait,
        CustomFunction;

    /**
     * @param Request $request
     * @return $this
     */
    public function getAllBookings(Request $request)
    {
        $dbBookings = Booking::orderBy('start_date', 'desc')
            ->whereIn('type', ['Workshop', 'Rouser', 'Tradeshow', 'Webinar', 'ELS', 'ELS + Workshop'])
            ->where('start_date', '>=', Carbon::today()->subYear())
            ->with(['rm', 'bookingTrainers.user']);

        if ($request->has('rm')) {
            $dbBookings->where('rm_user_id', '=', $request->rm);
        }

        if ($request->has('trainer')) {
            $dbBookings->whereHas('bookingTrainers', function ($query) use ($request) {
                $query->where('user_id', '=', $request->trainer);
            });
        }

        if ($request->has('search_students')) {
            $student = trim($request->search_students);
            $dbBookings->whereHas('bookingParticipants.user', function ($query) use ($student) {
                $query->where('first_name', 'like', "%$student%")
                    ->orWhere('last_name', 'like', "%$student%")
                    ->orWhere(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'like', "$student%");
            });
        }

        if ($request->has('search_bookings')) {
            $dbBookings->where('company', 'like', "$request->search_bookings%")
                ->orWhere('location_city', 'like', "$request->search_bookings%")
                ->orWhere('location_state', 'like', "$request->search_bookings%")
                ->orWhere('location_country', 'like', "$request->search_bookings%");
        }

        $bookings = [];

        $dbBookings->get()->each(function ($item) use (&$bookings) {
            if (!empty($item->start_date)) {
                $bookings[$item->start_date->format('ym')][] = $item;
            }
        });

        return view('intranet.bookings')->with([
            'bookings' => $bookings,
            'rm' => $this->getManagerListArray(),
            'trainers' => $this->getTrainerListArray(),
            'term_request' => $request->all()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllBookouts()
    {
        $dbBookout = Booking::orderBy('start_date', 'desc')
            ->where('type', '=', 'Bookout')
            ->where('start_date', '>=', Carbon::today()->subYear());
        $bookouts = [];
        foreach ($dbBookout->get() as $item) {
            $bookouts[date('ym', strtotime($item->start_date))][] = $item;
        }
        return view('intranet.bookouts')->with(['bookouts' => $bookouts]);
    }

    /**
     * Return one bookout
     *
     * @param Request $request
     * @return $this
     */
    public function getOneBookout(Request $request)
    {
        if ($request->id === 'new') {
            return view('intranet.new-bookout');
        }
        $bookout = Booking::where('id', $request->id)->where('type', '=', 'Bookout')->first();

        return view('intranet.bookout')->with(['bookout' => $bookout]);
    }

    /**
     * @return View
     */
    public function getNewBooking()
    {
        return view('intranet.new-booking')->with([
            'booking' => new Booking(),
            'trainers' => $this->getTrainerListArray(),
            'rm' => $this->getManagerListArray(),
            'country' => $this->country(),
            'state' => $this->state()
        ]);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\Response|View
     */
    public function getOneBooking(Request $request)
    {
        $trainers = [];
        $managers = [];

        foreach ($this->getManagerList() as $manager) {
            $managers[$manager->id] = $manager->full_name;
        }


        foreach ($this->getTrainersList() as $trainer) {
            $trainers[$trainer->id]['trainer_name'] = $trainer->full_name;
            $trainers[$trainer->id]['booking'] = false;
        }

        $booking = Booking::with('bookingParticipants.user')
            ->with('bookingTrainers.user')->with('BookingDays.lesson')->findOrFail($request->id);
        if ($booking->type == 'Bulk') {
            return response()->view('errors.404', [], 404);
        }
        $bookingTrainers = [];

        foreach ($booking->bookingTrainers as $bookingTrainer) {
            if ($bookingTrainer->user != null) {
                $bookingTrainers[$bookingTrainer->user_id]['booking'] = true;
            }
        }

        foreach ($trainers as $key => $trainer) {
            $trainers[$key]['booking'] = (isset($bookingTrainers[$key]['booking'])) ? true : false;
        }

        $bookingDays = [];
        /*foreach (BookingDays::select('booking_date')->where('booking_id', '=', $request->id)->distinct()->get()
            as $bookingDay) {
            $bookingDays[] = $bookingDay;
        }*/

        $numDay = 0;

      /*  $booking->BookingDays->each(function($item, $key) use (&$bookingDays) {
            $bookingDays[$item->booking_date] = $item;
        });

        dd($bookingDays);*/
        foreach ($booking->BookingDays as $bookingDay) {
            $bookingDateStart = BookingSchedule::where('booking_day', $bookingDay['booking_date'])->first();

            if (empty($bookingDays[$bookingDay['booking_date']]['time_start'])) {
                $bookingDays[$bookingDay['booking_date']]['time_start'] =
                    $bookingDateStart->start ?? $bookingDay['time_start'];
                $bookingDays[$bookingDay['booking_date']]['num'] = ++$numDay;
            }
            $bookingDays[$bookingDay['booking_date']]['time_end'] = $bookingDateStart->end ?? $bookingDay['time_end'];
            $bookingDays[$bookingDay['booking_date']]['lessons'][$bookingDay['id']] = $bookingDay;
            $bookingDays[$bookingDay['booking_date']]['lessons'][$bookingDay['id']]->time_start
                = date('h:i A', strtotime($bookingDay->time_start));
        }
        ksort($bookingDays);

////// !!!!!!!!!!!!!!!
        /*$datetime = new \DateTime($booking->start_date);
        $datetime2 = new \DateTime($booking->end_date);*/

        $curriculum['startDate'] = $booking->start_date->format('c');
        $curriculum['endDate'] = $booking->end_date->format('c');

        return view('intranet.booking')->with([
            'booking' => $booking,
            'trainers' => $trainers,
            'rm' => $managers,
            'lessons' => Lesson::all(),
            'booking_id' => $request->id,
            'curriculum' => $curriculum,
            'booking_days' => $bookingDays,
            'ina_type' => [
                -1 => 'No INA',
                3 => 'Standard INA',
                5 => 'Retention',
                4 => 'Standard INA w/ Pre-work',
                6 => 'Standard: Spanish',
                7 => 'Standard: French',
                8 => 'Standard: Mandarin',
                9 => 'Standard: Portuguese'
            ],
            'country' => $this->country(),
            'state' => $this->state()
        ]);
    }

    /**
     * Create Booking
     *
     * @param BookingRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createBooking(BookingRequest $request)
    {
        $data = $request->all();
        $data['start_date'] = Carbon::createFromFormat('m/d/Y', $request->start_date)->toDateTimeString();
        $data['end_date'] = Carbon::createFromFormat('m/d/Y', $request->end_date)->toDateTimeString();
        $data['booker_user_id'] = Auth::user()->id;
        if ($request->rm_user_id == "") {
            $data['rm_user_id'] = null;      ///// вопрос
        }

        $booking = Booking::create($data);
        if (!empty($request->trainerIds)) {
            $this->saveBookingTrainer($request->trainerIds, $booking->id);
        }

        Flashy::message('Booking sheet saved');
        return redirect()->route('booking', $booking->id);
    }

    /**
     * Create Bookout
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createBookout(Request $request)
    {
        $data = $request->all();
        $data['start_date'] = Carbon::createFromFormat('m/d/Y', $request->start_date)->toDateTimeString();
        $data['end_date'] = Carbon::createFromFormat('m/d/Y', $request->end_date)->toDateTimeString();
        $data['booker_user_id'] = Auth::user()->id;
        $data['type'] = 'Bookout';
        $data['title'] = 'Book Out';
        $data['title'] = 'Pinper Book Out';
        $data['location_city'] = 'Book Out';

        $bookout = Booking::create($data);

        Flashy::message('Bookout create');
        return redirect('intranet/bookout/' . $bookout->id);
    }

    /**
     * Update booking
     *
     * @param UpdateBookingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveBooking(UpdateBookingRequest $request)
    {
        if (!empty($request->curriculum)) {
            $this->saveCurriculum(json_decode($request->curriculum, true));
        }

        $data = $request->except(
            '_token',
            'booking_id',
            'trainerIds',
            'booking_trainers',
            'curriculum',
            'file',
            'ddp-file',
            'start_time',
            'end_time',
            'current_day'
        );
        $data['start_date'] = Carbon::parse($request->start_date);
        $data['end_date'] = Carbon::parse($request->end_date);

        if (empty($data['part'])) {
            $data['part'] = 0;
        }

        $data['expenses_complete'] = $request->expenses_complete ?? '0';

        if ($request->rm_user_id == "") {
            $data['rm_user_id'] = null;
        }

        if (!empty($request->trainerIds)) {
            $this->saveBookingTrainer($request->trainerIds, $request->booking_id, $request->booking_trainers);
        }

        Booking::where('id', $request->booking_id)
            ->update($data);
        Flashy::message('Booking sheet saved');

        return redirect()->back();
    }

    /**
     * Update bookout
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveBookout(Request $request)
    {
        $data = $request->except('_token', 'bookout_id');
        $data['start_date'] = Carbon::createFromFormat('m/d/Y', $request->start_date)->toDateTimeString();
        $data['end_date'] = Carbon::createFromFormat('m/d/Y', $request->end_date)->toDateTimeString();


        Booking::where('id', $request->bookout_id)
            ->update($data);
        Flashy::message('Bookout update');

        return redirect()->back();
    }

    /**
     * Save booking trainer
     *
     * @param  array $data
     * @param integer $bookingId
     */
    public function saveBookingTrainer($data, $bookingId, $bookingTrainers = null)
    {
        foreach ($data as $userId) {
            if (!$trainer = BookingTrainers::where('booking_id', $bookingId)->where('user_id', $userId)->first()) {
                BookingTrainers::create([
                    'booking_id' => $bookingId,
                    'user_id' => $userId
                ]);
            } elseif (!empty($bookingTrainers[$trainer->id])) {
                foreach ($bookingTrainers[$trainer->id] as $btKey => $btVal) {
                    $trainer->$btKey = $btVal;
                }
                $trainer->save();
            }
        }
    }


    /**
     * @param array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveCurriculum(array $data)
    {
        foreach ($data as $one) {
            $schedule = BookingSchedule::where('booking_id', $one['booking_id'])
                ->where('booking_day', Carbon::parse($one['booking_date'])->format('Y-m-d'))->first();
            if ($schedule != null) {
                $start = ($schedule->start != null) ? $schedule->start : '01:00:00';
                $end = ($schedule->end != null) ? $schedule->end : '24:00:00';
                if ($one['time_start'] < $start || $one['time_end'] > $end) {
                    $message = "Booking day ($schedule->booking_day) start $start and end $end";
                    return redirect()->back()->with('error_curriculum', $message);
                }
            }
            if (!isset($one['id'])) {
                BookingDays::create($one);
            } else {
                BookingDays::where('id', $one['id'])->update($one);
            }
        }
    }

    /**
     * Dublicate Booking
     * @param Booking $oldBooking
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAsBooking(Booking $oldBooking)
    {
        $data['title'] = $oldBooking->title;
        $data['start_date'] = $oldBooking->start_date;
        $data['end_date'] = $oldBooking->end_date;
        $data['company'] = $oldBooking->company;
        $data['location_city'] = $oldBooking->location_city;
        $data['company_website'] = $oldBooking->company_website;
        $data['company_contact'] = $oldBooking->company_contact;
        $data['client_phone'] = $oldBooking->client_phone;
        $data['client_email'] = $oldBooking->client_email;
        $data['details'] = $oldBooking->details;
        $data['booker_user_id'] = Auth::user()->id;
        if ($oldBooking->rm_user_id == null) {
            $data['rm_user_id'] = null;      ///// вопрос
        }

        $booking = Booking::create($data);

        /// copy booking file
        $oldBooking->bookingAssets->each(function ($item, $kay) use ($booking) {
            $media = $item->assets->getMedia()->first();
            $asset = Assets::create([
                'type' => $item->assets->type,
                'user_id' => Auth::user()->id
            ]);
            $asset->addMediaFromUrl($media->getUrl())->toCollection('booking');
            BookingAssets::create([
                'booking_id' => $booking->id,
                'asset_id' => $asset->id
            ]);
        });
        //copy booking curriculum
        $oldBooking->bookingDays->each(function ($item) use ($booking) {
            $data = $item->toArray();
            $data['booking_id'] = $booking->id;
            BookingDays::create($data);
        });

        Flashy::message('Booking copied');
        return redirect()->route('booking', $booking->id);
    }
}
