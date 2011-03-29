<?php
/**
 * Gtalk
 *
 * Get webHookId
 * @link http://gtalk-hook.appspot.com/
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Logger_Writer_Gtalk extends Q_Logger_Writer_Abstract
{
    const URL = 'https://gtalk-hook.appspot.com/ghook';
    protected $_webHookId;
    protected $_curl;

    /**
     * @param string $webHookId You webhookid
     */
    public function __construct($webHookId)
    {
        $this->_webHookId = $webHookId;
        $this->_curl = curl_init(self::URL);
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->_curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($this->_curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($this->_curl, CURLOPT_POST, 1);
    }

    protected function _write($message, $priority)
    {
        $message = 'Datetime: ' . $this->getDateTime() . "\n"
                 . 'Priority: ' . $this->priorityCodeToString($priority) . "\n"
                 . 'IP: ' . $this->getIp() . "\n\n"
                 . $message;

        curl_setopt($this->_curl, CURLOPT_POSTFIELDS, 'webhookid=' . $this->_webHookId . '&message=' . $message);
        $response = curl_exec($this->_curl);
        
        if ($response != 'Sent') {
            throw new Q_Logger_Writer_Exception("Gtalk: {$response}");
        }

        return true;
    }

    public function __destruct()
    {
        curl_close($this->_curl);
    }
}