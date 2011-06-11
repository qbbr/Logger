<?php
/**
 * SpVoice
 *
 * Only for Windows, just for fun
 *
 * @package Q_Logger
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Logger_Writer_SpVoice extends Q_Logger_Writer_Abstract
{
    protected $_volume;
    protected $_rate;

    /**
     * @param integer $volume
     * @param integer $rate
     */
    public function __construct($volume = 100, $rate = 0)
    {
        $this->_volume = $volume;
        $this->_rate = $rate;
    }

    protected function _write($message, $priority)
    {
        $spVoice = new COM('SAPI.SpVoice');
        $spVoice->Rate = $this->_rate;
        $spVoice->Volume = $this->_volume;
        $spVoice->Speak($message);
    }
}
