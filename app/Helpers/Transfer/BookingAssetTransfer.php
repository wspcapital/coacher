<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 28.01.17
 * Time: 18:25
 */

namespace App\Helpers\Transfer;

use App\Models\Assets;
use App\Models\BookingAssets;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BookingAssetTransfer extends Transfer
{
    public static function transfer($asset)
    {
        $trans = new BookingAssetTransfer();
        $trans->saveBookingFile($asset);
    }

    public function saveBookingFile($asset)
    {
        $url = 'https://pinper.com/assets/' . strtolower($asset->type) .
            's/' . $asset->user_id . '/' . $asset->filename;
        //dd($url);
        $file_headers = @get_headers($url);    /////  file_exist
        if (false !== strpos($file_headers[0], '200 OK')) {
            $assetNew = Assets::create([
                'id' => $asset->id,
                'user_id' => 1,
                'type' => $asset->type
            ]);
            if (preg_match('/http/', $asset->original_name)) {
                $fileName = $asset->filename;
            } else {
                $fileName = $asset->original_name;
            }

            $uploadPath = 'booking/trans/' . $asset->id . '/' . $fileName;
            //dd($uploadPath);
            $this->saveFile($url, $uploadPath, $assetNew, $asset->filename);
            // return view('test');
            BookingAssets::create([
                'asset_id' => $asset->id,
                'booking_id' => $asset->user_id
            ]);
        }
    }

    public function saveFile($pathFile, $uploadPath, $asset, $filename)
    {
        $contents = file_get_contents($pathFile);
        Storage::put($uploadPath, $contents);

        // dd();
        $file = new UploadedFile(
            storage_path("app/public/upload/booking/trans/$asset->id/$filename"),
            $filename,
            Storage::mimeType($uploadPath),
            Storage::size($uploadPath),
            null,
            true
        );
        $asset->addMedia($file)->toCollection('booking');
        Storage::deleteDirectory('booking/trans');
        // dd($file);
    }
}
