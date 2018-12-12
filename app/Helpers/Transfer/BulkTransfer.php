<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 01.02.17
 * Time: 10:05
 */

namespace App\Helpers\Transfer;

use App\Models\Booking;
use App\Models\BookingParticipants;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BulkTransfer extends Transfer
{
    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public static function transfer($order)
    {
        $trans = new BulkTransfer($order);
        $trans->saveBulk();
    }

    public function saveBulk()
    {
        $data = [
            'created_at' => ($this->order->created_at[0] == "0")
                ? date('Y-m-d H:i:s', time()) : $this->order->created_at,
            'updated_at' => ($this->order->updated_at[0] == "0")
                ? date('Y-m-d H:i:s', time()) : $this->order->updated_at,
            'start_date' => null,
            'end_date' => null,
            'booker_user_id' => $this->order->booker_id ?? 1,
            'rm_user_id' => $this->order->rm_id,
            'type' => $this->order->source,
            'title' => null,
            'company' => $this->order->bulk_company,
            'company_website' => null,
            'company_contact' => $this->order->bulk_contact,
            'client_phone' => $this->order->bulk_phone,
            'client_email' => $this->order->bulk_email ?? null,
            'details' => $this->order->admin_notes ?? null,
            //'location_name' => $bookingSheet->location_name,
            'location_city' => $this->order->bulk_city,
            'location_state' => $this->order->bulk_state,
            //'location_address' => $bookingSheet->location_address,
            //'location_zip' => $bookingSheet->location_zip,
            'location_country' => $this->order->bulk_country,
            'vcoaches' => $this->order->vcoaches ?? 0,
            'sessions' => $this->order->sessions ?? 0,
        ];
        //dd($data);

        if (User::where('id', $this->order->booker_id)->count() == 0) {
            $data['booker_user_id'] = 1;
        }
        if (User::where('id', $this->order->rm_id)->count() == 0) {
            $data['rm_user_id'] = 1;
        }

        $bulk = Booking::create($data);

        $participants = DB::connection('pinnacle')->table('participants')->where('owner_id', $this->order->id)
            ->where('owner_type', 'Bulk');
        if ($participants->count() > 0) {
            foreach ($participants->get() as $participant) {
                if (User::where('id', $participant->user_id)->count() > 0) {
                    $this->saveParticipant($participant, $bulk);
                }
            }
        }
    }

    public function saveParticipant($participant, $bulk)
    {
        $data = [
            'id' => $participant->id,
            'created_at' => $participant->created_at,
            'updated_at' => $participant->updated_at,
            'data' => $participant->data,
            'type' => "Bulk",
            'share_hash' => $participant->share_hash,
            'booking_id' => $bulk->id,
            'booking_trainers_id' => $participant->trainer_id,
            'user_id' => $participant->user_id
        ];

        BookingParticipants::create($data);
    }
}
