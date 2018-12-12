<?php

namespace App\Http\Controllers;

use App\Helpers\Transfer\BookingTransfer;
use App\Helpers\Transfer\BulkTransfer;
use App\Helpers\Transfer\CreditTransfer;
use App\Helpers\Transfer\Logger\MyLogger;
use App\Helpers\Transfer\UserVideoTransfer;
use App\Models\Assets;
use App\Models\BookingAssets;
use App\Models\BookingTrainers;
use App\Models\Traits\LaratrustCustomTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use GrahamCampbell\Dropbox\Facades\Dropbox;
use GrahamCampbell\Dropbox\DropboxManager;

class TestController extends Controller
{
    use LaratrustCustomTrait;

    public function getIndex()
    {

        $redis = Redis::connection();
        $redis->set('name', 'Тейлор');

        $name = $redis->get('name');
        dd($name);
        /*   $users = DB::connection('pinnacle')->table('users')
            ->where('id', '=', 6667)
            //->join('bookings', 'bookings.sheet_id', '=', 'booking_sheets.id')
            ->take(10)
            ->get();

        foreach ($users as $user) {
           // dd($user);
            CreditTransfer::transfer($user);
        }*/
    }

    public function getExpert()
    {
        return view('test-expert');
    }
}
