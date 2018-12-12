<?php
/**
 * Created by PhpStorm.
 * User: ubuntu16
 * Date: 06.02.17
 * Time: 23:06
 */

namespace App\Helpers\Transfer;

use App\Helpers\Transfer\Logger\LibLogger,
    App\Models\Assets,
    App\Models\Lib,
    Illuminate\Http\UploadedFile,
    Illuminate\Support\Facades\Storage;

class LibTransfer extends Transfer
{
    protected $asset;
    protected $logger;
    protected $libCategories = [
        '1' => '13',
        '2' => '14',
        '3' => '15',
        '4' => '16',
        '9' => '17',
        '10' => '23',
        '11' => '32',
        '12' => '33',
        '13' => '34',
        '14' => '24',
        '16' => '35',
        '18' => '25',
        '19' => '36',
        '20' => '18',
        '21' => '26',
        '22' => '19',
        '23' => '37',
        '25' => '20',
        '34' => '27',
        '36' => '28',
        '37' => '29',
        '38' => '30',
        '39' => '31',
        '27' => '40',
        '28' => '41',
        '29' => '42',
        '30' => '43',
        '31' => '44'
    ];

    public function __construct($asset)
    {
        $this->asset = $asset;
        $this->logger = new LibLogger();
    }

    public static function transfer($asset)
    {

        $trans = new LibTransfer($asset);
        $trans->saveVideo();
    }

    public function saveVideo()
    {
        if (empty($this->libCategories[$this->asset->category])) {
            return;
        }

        $convertedFileName = (!$this->asset->converted)
            ? $this->asset->filename : preg_replace('/\..+/', '', $this->asset->filename) . '.mp4';

        $url = 'https://pinper.com/assets/' . strtolower($this->asset->type) . 's/'
            . $this->asset->user_id . '/' . $convertedFileName;

        $file_headers = @get_headers($url);
        if (false !== strpos($file_headers[0], '200 OK')) {
            $assetNew = Assets::create([
                'id' => $this->asset->id,
                'user_id' => (empty($this->asset->id) || $this->asset->id == 0) ? 1 : $this->asset->id,
                'type' => $this->asset->type
            ]);

            $libs = Lib::create([
                'asset_id' => $this->asset->id,
                'title' => $this->asset->title,
                'category_id' => $this->libCategories[$this->asset->category],
                'description' => $this->asset->description
            ]);

            $uploadPath = 'library/trans/' . $this->asset->id . '/' . $convertedFileName;
            $contents = file_get_contents($url);
            Storage::put($uploadPath, $contents);

            if (Storage::size($uploadPath) > 20000) {
                $file = new UploadedFile(
                    storage_path("app/public/upload/library/trans/" . $this->asset->id . "/$convertedFileName"),
                    $convertedFileName,
                    Storage::mimeType($uploadPath),
                    Storage::size($uploadPath),
                    null,
                    true
                );

                if ($assetNew->addMedia($file)->toCollection('library')) {
                    $this->logger->info(
                        'asset.id = ' . $this->asset->id . ' Видео UserAssets.id = '
                        . $libs->id . ' загруженно в ' .
                        "'storage/app/public/upload/Library/trans/" . $this->asset->id . "/" . $convertedFileName . "')"
                    );
                } else {
                    $this->logger->info(
                        'asset.id = ' . $this->asset->id . ' размер ' . Storage::size($uploadPath)
                    );
                }
            }

            Storage::deleteDirectory('library/trans');
        } else {
            $this->logger->error('asset.id = ' . $this->asset->id .
                ' users.id = ' . $this->asset->user_id . 'Не является файлом url = ' . $url);
        }
    }
}
