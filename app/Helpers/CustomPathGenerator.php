<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 18.11.16
 * Time: 12:28
 */

namespace App\Helpers;

use Spatie\MediaLibrary\PathGenerator\PathGenerator,
    Spatie\MediaLibrary\Media;

/**
 * Class CustomPathGenerator
 * @package App\Helpers
 */
class CustomPathGenerator implements PathGenerator
{
    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media) : string
    {

        return $media->collection_name . "/" . $media->model_id . "/";
    }
    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     * @return string
     */
    public function getPathForConversions(Media $media) : string
    {
        return $media->collection_name . "/" . $media->model_id . "/";
    }
}
