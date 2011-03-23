<?php
/**
 * File
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Logger_Writer_File extends Q_Logger_Writer_Abstract
{
    protected $_file;

    /**
     * @param string $file Путь до файла
     * @throws Q_Logger_Writer_Exception
     */
    public function __construct($file)
    {
        if (!is_file($file)) {
            if (@!touch($file)) {
                throw new Q_Logger_Writer_Exception("File ({$file}) not found");
            }
        }

        if (!is_writable($file)) {
            throw new Q_Logger_Writer_Exception("File ({$file}) is not writable");
        }

        if (!$this->_file = fopen($file, 'a')) {
            throw new Q_Logger_Writer_Exception("Could not open file ({$file})");
        }
    }

    public function __destruct()
    {
        if ($this->_file) {
            fclose($this->_file);
        }
    }

    protected function _write($message, $priority)
    {
        fwrite($this->_file, "[{$this->getDateTime()}]"
               . " [{$this->priorityCodeToString($priority)}]"
               . " [client {$this->getIp()}] "
               . $message . PHP_EOL);
    }
}