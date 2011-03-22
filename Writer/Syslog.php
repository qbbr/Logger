<?php
/**
 * Syslog
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Logger_Writer_Syslog extends Q_Logger_Writer_Abstract
{
    protected function _write($message, $priority)
    {
        return syslog($priority, "[{$this->priorityCodeToString($priority)}] [client {$this->getIp()}] {$message}");
    }
}