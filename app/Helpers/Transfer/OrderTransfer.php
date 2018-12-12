<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 30.01.17
 * Time: 11:08
 */

namespace App\Helpers\Transfer;

use App\Helpers\Transfer\Logger\OrdersVideoLogger,
    App\Models\Assets,
    App\Models\Order,
    Illuminate\Http\UploadedFile,
    Illuminate\Support\Facades\DB,
    Illuminate\Support\Facades\Storage,
    App\Models\OrderAssets,
    GrahamCampbell\Dropbox\Facades\Dropbox;
use App\Models\Booking;
use App\Models\BookingParticipants;
use App\Models\Formers;
use App\Models\User;

class OrderTransfer extends Transfer
{
    protected $order;
    protected $logger;

    public function __construct($order)
    {
        $this->order = $order;
        $this->logger = new OrdersVideoLogger();
    }

    public static function transfer($order)
    {
        $trans = new OrderTransfer($order);
        $trans->saveOrder();
    }

    public function saveOrder()
    {
        $data = ($this->order->data != null) ? json_decode($this->order->data, true) : null;
        //dd($data);
        $timezone = $data['instructions']['timezone'] ?? null;

        $arr = [
            'id' => $this->order->id,
            'created_at' => ($this->order->created_at[0] == "0")
                ? date('Y-m-d H:i:s', time()) : $this->order->created_at,
            'updated_at' => ($this->order->updated_at[0] == "0")
                ? date('Y-m-d H:i:s', time()) : $this->order->updated_at,
            'booking_participants_id' => $this->getLastBookingParticipant(),
            'order_trainer_id' => $this->order->trainer_id,
            'due_at' => $this->order->due_at,
            'timezone' => $timezone,
            'source' => $this->order->source,
            'status' => $this->order->status,
            'type' => $this->order->type ?? 'Session',
            'data' => $this->order->data,
            'admin_notes' => $this->order->admin_notes,
            'coach_notes' => $this->order->coach_notes
        ];
        if (User::where('id', $this->order->trainer_id)->count() == 0) {
            $data['order_trainer_id'] = 1;
        }

        Order::create($arr);

        if ($this->order->asset_id) {
            $this->saveFile();
        }

        if ($this->order->trainer_prev_id) {
            Formers::create([
                'user_id' => $this->order->trainer_prev_id,
                'former_id' => $this->order->id,
                'type' => 'Order_trainer'
            ]);
        }
    }

    public function saveFile()
    {
        $asset = DB::connection('pinnacle')->table('assets')->where('id', $this->order->asset_id)->first();

        echo "Asset id = $asset->id \n";

        //// filename
        if (preg_match('/http/', $asset->original_name)) {
            $fileName = $asset->filename;
        } else {
            $fileName = $asset->original_name;
        }
        //// test
        if ($asset->converted && $asset->type == 'Video') {
            $fileName = preg_replace('/\..+/', '', $asset->filename) . '.mp4';
        }

        $url = 'https://pinper.com/assets/' . strtolower($asset->type) . 's/'
            . $asset->user_id . '/' . $fileName;
        echo $url;
        $file_headers = @get_headers($url);
        //dd($file_headers);/////  file_exist
        if (false !== strpos($file_headers[0], '200 OK')) {
            //  dd($url);
            $assetNew = Assets::create([
                'id' => $asset->id,
                'user_id' => 1,
                'type' => $asset->type
            ]);

            $data = ($this->order->data != null) ? json_decode($this->order->data, true) : null;
            //dd($data);
            $title = $data['instructions']['title'] ?? null;

            OrderAssets::create([
                'orders_id' => $this->order->id,
                'assets_id' => $assetNew->id,
                'title' => $title,
                'category_id' => 1
            ]);


            $uploadPath = 'video/trans/' . $asset->id . '/' . $fileName;
            $contents = file_get_contents($url);
            Storage::put($uploadPath, $contents);

            // dd();

            $file = new UploadedFile(
                storage_path("app/public/upload/video/trans/$asset->id/$fileName"),
                $this->getOriginalName($asset),
                Storage::mimeType($uploadPath),
                Storage::size($uploadPath),
                null,
                true
            );

            if ($assetNew->addMedia($file)->toCollection('video')) {
                $this->logger->info(
                    'order.id = ' . $this->order->id . ' Видео assets.id = '
                    . $this->order->asset_id . ' загруженно в ' .
                    "'storage/app/public/upload/video/trans/$asset->id/$fileName')"
                );

                //// VPR
                if ($this->order->report_id) {
                    $this->saveVideoFile();
                }
            }
            Storage::deleteDirectory('video/trans');
        } else {
            $this->logger->error('order.id = ' . $this->order->id .
                ' assets.id = ' . $this->order->asset_id . ' Не является файлом url = ' . $url);
        }
    }

    public function saveVideoFile()
    {
        $asset = DB::connection('pinnacle')->table('assets')->where('id', $this->order->report_id)->first();

        echo "[VPR] Asset id = $asset->id \n";

        $url = '/assets/' . strtolower($asset->type) . 's/'
            . $asset->user_id . '/' . $asset->filename;

        /////  file_exist
        if (Dropbox::getMetadata($url)) {
            $assetNew = Assets::create([
                'id' => $asset->id,
                'user_id' => $asset->user_id,
                'type' => $asset->type
            ]);


            OrderAssets::create([
                'orders_id' => $this->order->id,
                'assets_id' => $assetNew->id,
                'category_id' => 5
            ]);

            //// filename
            if (preg_match('/http/', $asset->original_name)) {
                $fileName = $asset->filename;
            } else {
                $fileName = $asset->original_name;
            }

            $url = '/assets/pdfs/72/5886657ed3bc8.pdf';
            Storage::makeDirectory('vpr/trans/' . $asset->id);

            $uploadPath = storage_path('app/public/upload/vpr/trans/' . $asset->id) . '/' . $fileName;
            // dd($uploadPath);
            $f = fopen($uploadPath, "w+b");
            Dropbox::getFile($url, $f);

            $meta = Dropbox::getMetadata($url);
            // dd();

            $file = new UploadedFile(
                storage_path("app/public/upload/vpr/trans/$asset->id/$fileName"),
                $this->getOriginalName($asset),
                $meta['mime_type'],
                $meta['bytes'],
                null,
                true
            );

            if ($assetNew->addMedia($file)->toCollection('vpr')) {
                $this->logger->info(
                    ' VPR order.id = ' . $this->order->id . ' assets.id = '
                    . $this->order->asset_id . ' загруженно в ' .
                    "'storage/app/public/upload/vpr/trans/$asset->id/$fileName')"
                );
            }
            Storage::deleteDirectory('vpr/trans');
        } else {
            $this->logger->error('VPR order.id = ' . $this->order->id . ' assets.id = '
                . $this->order->asset_id . ' Не является файлом url = ' . $url);
        }
    }

    public function getLastBookingParticipant()
    {
        return BookingParticipants::where('user_id', $this->order->user_id)
                ->orderBy('created_at', 'desc')->first()->id ?? 1;
        /* return Booking::whereHas('bookingParticipants', function ($q) {
                 $q->where('user_id', $this->order->user_id);
             })->orderBy('created_at', 'desc')->first()->id ?? null;*/
    }

    public function getOriginalName($asset)
    {
        if ($asset->original_name == null) {
            return $asset->filename;
        } elseif (preg_match('/http/', $asset->original_name)) {
            $arr = explode('/', $asset->original_name);
            return $arr[count($arr) - 1];
        } else {
            return $asset->original_name;
        }
    }
}
