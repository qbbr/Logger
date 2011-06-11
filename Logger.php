<?php
/**
 * Logger
 *
 * @package Q_Logger
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Logger
{
    const LOG_EMERG = 0;   // system is unusable
    const LOG_ALERT = 1;   // action must be taken immediately
    const LOG_CRIT = 2;    // critical conditions
    const LOG_ERR = 3;     // error conditions
    const LOG_WARNING = 4; // warning conditions
    const LOG_NOTICE = 5;  // normal, but significant, condition
    const LOG_INFO = 6;    // informational message
    const LOG_DEBUG = 7;   // debug-level message

    /**
     * @var Q_Logger_Writer_Abstract
     */
    protected $_writers = array();

    /**
     * @param Q_Logger_Writer_Abstract|array $writers
     */
    public function __construct($writers)
    {
        if (is_array($writers)) {
            foreach ($writers as $writer) {
                $this->addWriter($writer);
            }
        } else {
            $this->addWriter($writers);
        }
    }

    /**
     * @param Q_Logger_Writer_Abstract $writer
     */
    public function addWriter(Q_Logger_Writer_Abstract $writer)
    {
        $this->_writers[]= $writer;
    }

    /**
     * Write to log
     * 
     * @param string $message
     * @param integer $priority
     */
    public function log($message, $priority = self::LOG_INFO)
    {
        foreach ($this->_writers as $writer) {
            $writer->write($message, $priority);
        }
    }
}
