<?php
/**
 * DB
 *
 * @package Q_Logger
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Logger_Writer_Db extends Q_Logger_Writer_Abstract
{
    protected function _write($message, $priority)
    {
        $logger = new Logger();
        $logger->ip = $this->getIp();
        $logger->priority = $priority;
        $logger->message = $message;
        $logger->save();
    }
}