<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request,
    App\Http\Controllers\Controller,
    App\Models\Booking,
    App\Models\BookingTrainers,
    Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Return all calendar events
     *
     * @param Request $request
     * @return mixed
     */
    public function getAllEvents(Request $request)
    {
        $events = [];
        $startDate = $request->start;
        $endDate = $request->end;

        if (empty($request->type) || $request->type != 'Bookout') {
            $bookings  = Booking::where('start_date', '>=', $startDate)->where('end_date', '<=', $endDate);

            if (!empty($request->type)) {
                $bookings->where('type', '=', $request->type);
            } else {
                $bookings->where('type', '!=', 'Bookout');
            }

            if (!empty($request->user)) {
                $bookings->with(['bookingTrainers.user' => function ($query) use ($request) {
                    $query->where('id', '=', $request->user);
                }]);
            } else {
                $bookings->with('bookingTrainers.user');
            }

            if (!empty($request->location) && $request->location == 'us') {
                $bookings->where('location_country', '=', 184);
            }

            $bookings->get()->each(function ($item) use (&$events) {
                if (!empty($item->bookingTrainers)) {
                    $item->bookingTrainers->each(function ($trainer) use (&$events, $item) {
                        if (!empty($trainer->user)) {
                            $title = [];
                            if ($trainer->car_rental_book) {
                                $title['icons'][] = 'carbook';
                            }
                            if ($trainer->flight_book) {
                                $title['icons'][] = 'airplane';
                            }
                            if ($trainer->hotel_book) {
                                $title['icons'][] = 'hotel';
                            }
                            if ($item->preport) {
                                $title['icons'][] = 'ddp';
                            }
                            if ($item->cap_required) {
                                $title['icons'][] = 'cap';
                            }
                            $title['fullName'] = $trainer->user->full_name;
                            $title['company'] = $item->company;
                            $title['location_city'] = $item->location_city;
                            $title['note'] = $trainer->note;
                            $title['logistics_ddp'] = $item->preport;
                            $events[] = [
                                'url' => url('intranet/booking') . '/' . $item->id,
                                'start' => $item->start_date->format("Y-m-d"),
                                'end' => $item->end_date->addDay()->format("Y-m-d"),
                                'title' => $title,

                                'booking_id' => $item->id,
                                'booking_type' => $item->type,
                                'color' => $trainer->user->color
                            ];
                        }
                    });
                }
            });
        }

        if (empty($request->type) || $request->type == 'Bookout') {
            $bookouts  = Booking::where('start_date', '>=', $startDate)->where('end_date', '<=', $endDate)
                ->where('type', '=', 'Bookout');

            if (!empty($request->user)) {
                $bookouts->with(['booker' => function ($query) use ($request) {
                    $query->where('id', '=', $request->user);
                }]);
            } else {
                $bookouts->with('booker');
            }
            $bookouts->get()->each(function ($item) use (&$events) {
                $events[] = [
                    'start' => $item->start_date->format("Y-m-d"),
                    'end' => $item->end_date->addDay()->format("Y-m-d"),
                    'title' => $item->booker->full_name . ':'
                        . $item->company . '(' . $item->location_city . ') Notes: '.$item->generalnote,
                    'url' =>  '/intranet/bookout/' . $item->id,
                    'booking_id' => $item->id,
                    'booking_type' => $item->type,
                    'color' => $item->booker->color,
                ];
            });
        }

        return response()->json($events);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchCalendar(Request $request)
    {
        $term = $request->term;
        if (!empty($request->term)) {
            $result = Booking::orWhere('title', 'like', '%'.$term.'%')
               ->orWhere('company', 'like', '%'.$term.'%')
               ->orWhere('location_city', 'like', '%'.$term.'%');
            return $result->get();
        }

        return false;
    }

    public function infoBooking(Request $request)
    {
        return view('intranet.partials.calendar-modal', [
                    'booking' => Booking::findOrFail($request->booking_id)
        ]);
    }
}
