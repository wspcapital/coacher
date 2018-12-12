<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 26.01.17
 * Time: 14:06
 */

namespace App\Helpers\Transfer;

use App\Models\Assets;
use App\Models\Booking,
    App\Models\BookingDays,
    App\Models\BookingParticipants,
    App\Models\BookingTrainers,
    App\Models\Lesson,
    Illuminate\Support\Facades\DB;
use App\Models\User;

class BookingTransfer extends Transfer
{
    public static function transfer($bookingSheet)
    {
        $trans = new BookingTransfer();
        $trans->insertBooking($bookingSheet);
    }

    public function insertBooking($bookingSheet)
    {
        $dataField = json_decode($bookingSheet->data, 1);

        $data = [
            'id' => $bookingSheet->id,
            "created_at" => ($bookingSheet->created_at == '0000-00-00 00:00:00') ? null : $bookingSheet->created_at,
            "updated_at" => ($bookingSheet->updated_at == '0000-00-00 00:00:00') ? null : $bookingSheet->updated_at,
            'start_date' => ($bookingSheet->start_date == '0000-00-00') ? null : $bookingSheet->start_date,
            'end_date' => ($bookingSheet->end_date == '0000-00-00') ? null : $bookingSheet->end_date,
            'booker_user_id' => $bookingSheet->booker_id,
            'rm_user_id' => $bookingSheet->rm_id,
            'type' => $bookingSheet->type ?? 'Workshop',
            'title' => $bookingSheet->title,
            'company' => $bookingSheet->company,
            'company_website' => $bookingSheet->company_website,
            'company_contact' => $bookingSheet->company_contact,
            'client_phone' => $bookingSheet->client_phone,
            'client_email' => $bookingSheet->client_email ?? null,
            'details' => $bookingSheet->details,
            'location_name' => $bookingSheet->location_name,
            'location_city' => $bookingSheet->location_city,
            'location_state' => $bookingSheet->location_state,
            'location_address' => $bookingSheet->location_address,
            'location_zip' => $bookingSheet->location_zip,
            'location_country' => $bookingSheet->location_country,
            'preport' => string($bookingSheet->preport),
            'cap_required' => string($bookingSheet->cap_required),
            'gna' => string($bookingSheet->gna),
            'evaluation' => string($bookingSheet->evaluation),
            'customwb' => string($bookingSheet->customwb),
            'pdp' => string($bookingSheet->pdp),
            'workbook' => string($bookingSheet->workbook),
            'part' => (is_numeric($bookingSheet->part)) ? $bookingSheet->part : 0,
            'ina_type' => ($bookingSheet->ina_type != null
                && $bookingSheet->ina_type != 0) ? string($bookingSheet->ina_type) : '3',
            'pdpship' => $bookingSheet->pdpship,
            'noteship' => $dataField['logistics']['shipping'] ?? null,
            'pdptrack' => $bookingSheet->pdptrack,
            'generalnote' => $dataField['logistics']['notes'] ?? null,
            'readybook' => string($bookingSheet->readybook),
            'event_hotels' => $bookingSheet->event_hotels,
            'travelnotes' => $bookingSheet->travelnotes,
            'accommodations' => $dataField['logistics']['accommodations'] ?? null,
            'corporate_rate' => $dataField['logistics']['corporate_rate'] ?? null,
            'transfer' => $dataField['logistics']['transportation'] ?? null,
            'expenses' => string($bookingSheet->expenses),
            'expenses_complete' => string($bookingSheet->expenses_complete),
            'materials' => string($bookingSheet->materials),
            'share_hash' => $bookingSheet->share_hash,
            'site_contact_fname' => $dataField['logistics']['site_contact_fname'] ?? null,
            'site_contact_lname' => $dataField['logistics']['site_contact_lname'] ?? null,
            'site_contact_phone' => $dataField['logistics']['site_contact_phone'] ?? null,
            'site_contact_email' => $dataField['logistics']['site_contact_email'] ?? null,
            'shipping' => $dataField['logistics']['shipping'] ?? null,
            'restaurants' => $dataField['logistics']['restaurants'] ?? null,
        ];

        if (User::where('id', $bookingSheet->booker_id)->count() == 0) {
            $data['booker_user_id'] = 1;
        }
        if (User::where('id', $bookingSheet->rm_id)->count() == 0) {
            $data['rm_user_id'] = 1;
        }
        Booking::create($data);
        $this->saveTrainer($bookingSheet->id);
        $this->saveParticipant($bookingSheet->id);
        $this->saveCurriculum($bookingSheet);
    }

    public function saveTrainer($oldBookingId)
    {
        $bookings = DB::connection('pinnacle')->table('bookings')->where('sheet_id', $oldBookingId)->get();

        foreach ($bookings as $booking) {
            if (User::where('id', $booking->user_id)->count() > 0) {
                $this->insertTrainer($booking);
            }
        }
    }

    public function insertTrainer($booking)
    {
        $data = [
            'id' => $booking->id,
            "created_at" => ($booking->created_at == '0000-00-00 00:00:00') ? null : $booking->created_at,
            "updated_at" => ($booking->updated_at == '0000-00-00 00:00:00') ? null : $booking->updated_at,
            'hotel_book' => string($booking->hotel_book),
            'hotel_name' => $booking->hotel_name,
            'hotel_address' => $booking->hotel_address,
            'flight_book' => string($booking->flight_book),
            'flight_info' => $booking->flight_info,
            'car_rental_book' => string($booking->car_rental_book),
            'car_rental' => string($booking->car_rental),
            'note' => $booking->notes,
            'booking_id' => $booking->sheet_id,
            'user_id' => $booking->user_id
        ];
        BookingTrainers::create($data);
    }

    public function saveParticipant($oldBookingId)
    {
        $participants = DB::connection('pinnacle')->table('participants')->where('owner_id', $oldBookingId)
            ->where('owner_type', 'BookingSheet')
            ->get();
        foreach ($participants as $p) {
            if (User::where('id', $p->user_id)->count() > 0) {
                $this->insertParticipant($p);
            }
        }
    }

    public function insertParticipant($p)
    {
        $bookingsTrainer = BookingTrainers::where('booking_id', $p->owner_id)
            ->where('user_id', $p->trainer_id)
            ->first();
        $data = [
            'id' => $p->id,
            "created_at" => ($p->created_at == '0000-00-00 00:00:00') ? null : $p->created_at,
            "updated_at" => ($p->updated_at == '0000-00-00 00:00:00') ? null : $p->updated_at,
            'data' => $p->data,
            'type' => 'BookingSheet',
            'share_hash' => $p->share_hash,
            'booking_id' => $p->owner_id,
            'booking_trainers_id' => $bookingsTrainer->id ?? null,
            'user_id' => $p->user_id
        ];
        BookingParticipants::create($data);
    }

    public function saveCurriculum($booking)
    {
        if ($booking->curriculum != "null" && $booking->curriculum != null) {
            echo $booking->id;
            $curriculum = json_decode($booking->curriculum, 1);
            $i = 0;
            //echo $curriculum;
            // dd($booking->curriculum);
            foreach ($curriculum['days'] as $day) {
                if (isset($day['times']) && !empty($day['times'])) {
                    // dd($day);
                    foreach ($day['times'] as $event) {
                        if (isset($event['lesson']) && isset($event['subtitle'])) {
                            // dd($event);
                            $lesson = Lesson::where('title', $event['lesson']['title']);
                            if ($lesson->count() > 0) {
                                $lesson_id = $lesson->first()->id;
                            } else {
                                $lesson_id = 1;
                            }
                            $data = [
                                'booking_id' => $booking->id,
                                'booking_date' => date("Y-m-d", strtotime("+$i day", strtotime($booking->start_date))),
                                'lesson_id' => $lesson_id,
                                'time_start' => date("H:i:s", strtotime($event['subtitle'])),
                                'time_end' => $this->getEndDate($event['subtitle'], $event['lesson']['time']),
                                'title' => $event['lesson']['title'],
                                'subtitle' => null,
                                'color' => $event['lesson']['color']
                            ];
                            BookingDays::create($data);
                        }
                    }
                }
                $i++;   ///  booking_date
            }
        }
    }

    public function getEndDate($startTime, $duration)
    {
        return date('H:i:s', strtotime($startTime . " + $duration min"));
    }
}
