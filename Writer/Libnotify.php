<?php
/**
 * Libnotify
 * 
 * Only for CLI, libnotify must be installed
 * (sudo aptitude install libnotify-bin)
 *
 * @package Q_Logger
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Logger_Writer_Libnotify extends Q_Logger_Writer_Abstract
{
    protected $_summary = '';
    protected $_icon = '';
    protected $_expireTime = 5000;
    
    /**
     * @param string $summary
     */
    public function setSummary($summary)
    {
        $this->_summary = $summary;
    }
    
    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->_icon = $icon;
    }
    
    /**
     * @param integer $milliseconds
     */
    public function setExpireTime($milliseconds)
    {
        $this->_expireTime = $milliseconds;
    }

    protected function _write($message, $priority)
    {
        exec(sprintf('notify-send -t %d --icon=%s %s %s', $this->_expireTime, $this->_icon, $this->_summary, $message));
    }
}