<?php
/**
 * Created by PhpStorm.
 * User: yarys
 * Date: 06.02.17
 * Time: 11:29
 */

namespace App\Helpers\Transfer;

use App\Helpers\Transfer\Logger\VideoTipLogger,
    App\Models\Assets,
    App\Models\Lib,
    Illuminate\Http\UploadedFile,
    Illuminate\Support\Facades\Storage;

class VideoTipTransfer extends Transfer
{
    protected $asset;
    protected $logger;

    public function __construct($asset)
    {
        $this->asset = $asset;
        $this->logger = new VideoTipLogger();
    }

    public static function transfer($asset)
    {

            $trans = new VideoTipTransfer($asset);
            $trans->saveVideo();
    }

    public function saveVideo()
    {
        $convertedFileName = (!$this->asset->converted)
            ? $this->asset->filename : preg_replace('/\..+/', '', $this->asset->filename) . '.mp4';

        $url = 'https://pinper.com/assets/' . strtolower($this->asset->type) . 's/'
            . $this->asset->user_id . '/' . $convertedFileName;

        $file_headers = @get_headers($url);
        if (false !== strpos($file_headers[0], '200 OK')) {
            $assetNew = Assets::create([
                'id' => $this->asset->id,
                'user_id' => 1,
                'type' => $this->asset->type
            ]);

            $libs = Lib::create([
                'asset_id' => $this->asset->id,
                'title' => $this->asset->title,
                'category_id' => 38,
                'description' => $this->asset->description
            ]);

            $uploadPath = 'video/trans/' . $this->asset->id . '/' . $convertedFileName;
            $contents = file_get_contents($url);
            Storage::put($uploadPath, $contents);

            if (Storage::size($uploadPath) > 20000) {
                $file = new UploadedFile(
                    storage_path("app/public/upload/video/trans/" . $this->asset->id . "/$convertedFileName"),
                    $convertedFileName,
                    Storage::mimeType($uploadPath),
                    Storage::size($uploadPath),
                    null,
                    true
                );

                if ($assetNew->addMedia($file)->toCollection('video')) {
                    $this->logger->info(
                        'asset.id = ' . $this->asset->id . ' Видео UserAssets.id = '
                        . $libs->id . ' загруженно в ' .
                        "'storage/app/public/upload/video/trans/" . $this->asset->id . "/" . $convertedFileName . "')"
                    );
                } else {
                    $this->logger->info(
                        'asset.id = ' . $this->asset->id . ' размер ' . Storage::size($uploadPath)
                    );
                }
            }

            Storage::deleteDirectory('video/trans');
        } else {
            $this->logger->error('asset.id = ' . $this->asset->id .
                ' users.id = ' . $this->asset->user_id . 'Не является файлом url = ' . $url);
        }
    }
}
