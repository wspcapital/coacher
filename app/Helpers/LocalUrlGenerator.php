<?php

namespace App\Helpers;

use Spatie\MediaLibrary\UrlGenerator\BaseUrlGenerator;

/**
 * Class LocalUrlGenerator
 * @package App\Helpers
 */
class LocalUrlGenerator extends BaseUrlGenerator
{
    /**
     * Get the url for the profile of a media item.
     *
     * @return string
     */
    public function getUrl():string
    {
        return 'storage/upload/' . $this->getPathRelativeToRoot();
    }
}
