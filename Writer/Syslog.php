<?php
/**
 * Syslog
 *
 * @package Q_Logger
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Logger_Writer_Syslog extends Q_Logger_Writer_Abstract
{
    protected function _write($message, $priority)
    {
        return syslog($priority, "[{$this->priorityCodeToString($priority)}] [client {$this->getIp()}] {$message}");
    }
}