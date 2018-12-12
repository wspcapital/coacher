<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 31.01.17
 * Time: 11:53
 */

namespace App\Helpers\Transfer\Logger;

use Monolog\Handler\StreamHandler,
    Monolog\Logger;

class UserVideoLogger implements MyLogger
{
    private $log;

    private $logFile = 'storage/logs/user-video.log';

    public function __construct()
    {
        $this->log = new Logger('video');
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
