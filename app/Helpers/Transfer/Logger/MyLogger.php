<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 31.01.17
 * Time: 11:46
 */

namespace App\Helpers\Transfer\Logger;

interface MyLogger
{
    public function info(string $message);

    public function error(string $message);
}
