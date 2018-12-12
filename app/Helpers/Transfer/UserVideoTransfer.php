<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 31.01.17
 * Time: 11:15
 */

namespace App\Helpers\Transfer;

use App\Helpers\Transfer\Logger\UserVideoLogger,
    App\Models\Assets,
    App\Models\UserAssets,
    Illuminate\Http\UploadedFile,
    Illuminate\Support\Facades\Storage;
use App\Models\DocVideo;
use GrahamCampbell\Dropbox\Facades\Dropbox;
use Illuminate\Support\Facades\DB;

class UserVideoTransfer extends Transfer
{
    protected $asset;
    protected $logger;

    public function __construct($asset)
    {
        $this->asset = $asset;
        $this->logger = new UserVideoLogger();
    }

    public static function transfer($asset)
    {
        $categoryId = false;

        switch ($asset->category) {
            case null:
                $categoryId = 2;
                break;
            case 35:
                $categoryId = 3;
                break;
            case 2:
                $categoryId = 4;
                break;
        }
        if ($categoryId) {
            $trans = new UserVideoTransfer($asset);
            $trans->saveVideo($categoryId);
        }
    }

    public function saveVideo($categoryId)
    {
        echo "Asset id = " . $this->asset->id . "\n";

        //// filename
        if (preg_match('/http/', $this->asset->original_name)) {
            $fileName = $this->asset->filename;
        } else {
            $fileName = $this->asset->original_name;
        }

        //// test
        if ($this->asset->converted && $this->asset->type == 'Video') {
            $fileName = preg_replace('/\..+/', '', $this->asset->filename) . '.mp4';
        }

        $url = 'https://pinper.com/assets/' . strtolower($this->asset->type) . 's/'
            . $this->asset->user_id . '/' . $fileName;

        $file_headers = @get_headers($url);    /////  file_exist
        if (false !== strpos($file_headers[0], '200 OK')) {
            $assetNew = Assets::create([
                'id' => $this->asset->id,
                'user_id' => 1,
                'type' => $this->asset->type
            ]);

            $userAssets = UserAssets::create([
                'asset_id' => $this->asset->id,
                'user_id' => $this->asset->user_id,
                'category_id' => $categoryId,
                'expires' => $this->asset->expires
            ]);

            $uploadPath = 'video/trans/' . $this->asset->id . '/' . $fileName;
            $contents = file_get_contents($url);
            Storage::put($uploadPath, $contents);

            if (Storage::size($uploadPath) > 20000) {
                $file = new UploadedFile(
                    storage_path("app/public/upload/video/trans/" . $this->asset->id . "/$fileName"),
                    $this->getOriginalName(),
                    Storage::mimeType($uploadPath),
                    Storage::size($uploadPath),
                    null,
                    true
                );

                if ($assetNew->addMedia($file)->toCollection('video')) {
                    $this->logger->info(
                        'asset.id = ' . $this->asset->id . ' Видео UserAssets.id = '
                        . $userAssets->id . ' загруженно в ' .
                        "'storage/app/public/upload/video/trans/" . $this->asset->id . "/" . $fileName . "')"
                    );

                    /*//// VPR
                    if ($this->order->report_id) {
                        $this->saveVideoFile(new TransferLogger());
                    }*/
                } else {
                    $this->logger->info(
                        'asset.id = ' . $this->asset->id . ' размер ' . Storage::size($uploadPath)
                    );
                }
            }
            // dd();


            Storage::deleteDirectory('video/trans');
            $this->checkVideoDoc();
        } else {
            $this->logger->error('asset.id = ' . $this->asset->id .
                ' users.id = ' . $this->asset->user_id . 'Не является файлом url = ' . $url);
        }
    }

    public function checkVideoDoc()
    {
        $docVideos = DB::connection('pinnacle')->table('assets')
            ->where('order', $this->asset->id);
        if ($docVideos->count() > 0) {
            foreach ($docVideos->get() as $docVideo) {
                $this->saveVideoFile($docVideo);
            }
        }
    }

    public function saveVideoFile($assetDoc)
    {
        echo "[VideoFile] Asset id = " . $assetDoc->id . "\n";

        $url = '/assets/' . strtolower($assetDoc->type) . 's/'
            . $assetDoc->user_id . '/' . $assetDoc->filename;

        /////  file_exist
        if (Dropbox::getMetadata($url)) {
            $assetNew = Assets::create([
                'id' => $assetDoc->id,
                'user_id' => $assetDoc->user_id,
                'type' => $assetDoc->type
            ]);


            DocVideo::create([
                'file_id' => $assetDoc->order,
                'doc_id' => $assetDoc->id,
            ]);

            //// filename
            if (preg_match('/http/', $assetDoc->original_name)) {
                $fileName = $assetDoc->filename;
            } else {
                $fileName = $assetDoc->original_name;
            }

            $url = '/assets/pdfs/' . $assetDoc->user_id . '/' . $assetDoc->filename;
            Storage::makeDirectory('doc/trans/' . $assetDoc->id);

            $uploadPath = storage_path('app/public/upload/doc/trans/' . $assetDoc->id) . '/' . $fileName;
            // dd($uploadPath);
            $f = fopen($uploadPath, "w+b");
            Dropbox::getFile($url, $f);

            $meta = Dropbox::getMetadata($url);
            // dd();

            $file = new UploadedFile(
                storage_path("app/public/upload/doc/trans/$assetDoc->id/$fileName"),
                $this->getOriginalName(),
                $meta['mime_type'],
                $meta['bytes'],
                null,
                true
            );
           /* dd($file);*/
            if ($assetNew->addMedia($file)->toCollection('doc')) {
                $this->logger->info(
                    ' VDoc asset.id = ' . $assetDoc->id . ' user.id = '
                    . $assetDoc->user_id . ' загруженно в ' .
                    "'storage/app/public/upload/doc/trans/' . $assetDoc->id . '/' . $fileName .')"
                );
            }
            Storage::deleteDirectory('doc/trans');
        } else {
            $this->logger->error('VDoc asset.id = ' . $assetDoc->id . ' user.id = '
                . $assetDoc->user_id . 'Не является файлом url = ' . $url);
        }
    }

    public function getOriginalName()
    {
        if ($this->asset->original_name == null) {
            return $this->asset->filename;
        } elseif (preg_match('/http/', $this->asset->original_name)) {
            $arr = explode('/', $this->asset->original_name);
            return $arr[count($arr) - 1];
        } else {
            return $this->asset->original_name;
        }
    }
}
