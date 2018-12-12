<?php
/**
 * Created by PhpStorm.
 * User: yarys
 * Date: 06.02.17
 * Time: 11:21
 */

namespace App\Helpers\Transfer\Logger;

use Monolog\Handler\StreamHandler,
    Monolog\Logger;

class VideoTipLogger implements MyLogger
{
    private $log;

    private $logFile = 'storage/logs/video-tips.log';

    public function __construct()
    {
        $this->log = new Logger('video-tips');
        $this->log->pushHandler(new StreamHandler($this->logFile, Logger::DEBUG));
    }

    public function info(string $message)
    {
        $this->log->info($message);
    }

    public function error(string $message)
    {
        $this->log->error($message);
    }
}
