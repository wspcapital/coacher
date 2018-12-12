<?php
/**
 * Created by PhpStorm.
 * User: ubuntu16
 * Date: 06.02.17
 * Time: 23:30
 */
namespace App\Helpers\Transfer\Logger;

use Monolog\Handler\StreamHandler,
    Monolog\Logger;

class LibLogger implements MyLogger
{
    private $log;

    private $logFile = 'storage/logs/libs.log';

    public function __construct()
    {
        $this->log = new Logger('libs');
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
