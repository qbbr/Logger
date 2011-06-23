<?php
/**
 * Mail
 *
 * @package Q_Logger
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Logger_Writer_Mail extends Q_Logger_Writer_Abstract
{
    protected $_from;
    protected $_to;

    /**
     * @param string $to
     * @param string $from
     */
    public function __construct($to, $from = null)
    {
        $this->_to = $to;
        $this->_from = $from;
    }

    protected function _write($message, $priority)
    {
        $subject = 'Log [' . $this->priorityCodeToString($priority) . ']';
        $message = 'Datetime: ' . $this->getDateTime() . "\n"
                 . 'Priority: ' . $this->priorityCodeToString($priority) . PHP_EOL
                 . 'IP: ' . $this->getIp() . PHP_EOL . PHP_EOL
                 . $message;

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        if (null !== $this->_from) $headers .= "From: {$this->_from}\r\n";

        mail($this->_to, $subject, $message, $headers);
    }
}