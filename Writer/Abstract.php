<?php
/**
 * Abstract
 *
 * @package Q_Logger
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
abstract class Q_Logger_Writer_Abstract
{
    /**
     * Write to log
     *
     * @param string $message Сообщение
     * @param integer $priority Приоритет
     */
    public function write($message, $priority)
    {
        $this->_write($message, $priority);
    }

    abstract protected function _write($message, $priority);

    /**
     * Get current datetime
     *
     * @access protected
     * @return string
     */
    protected function getDateTime()
    {
        return date('d/m/Y H:i:s');
    }

    /**
     * Get priority name
     *
     * @access protected
     * @param integer $priority
     * @return string
     */
    protected function priorityCodeToString($priority)
    {
        switch ($priority) {
            case 0:
                return 'EMERG';
                break;

            case 1:
                return 'ALERT';
                break;

            case 2:
                return 'CRIT';
                break;

            case 3:
                return 'ERR';
                break;

            case 4:
                return 'WARNING';
                break;

            case 5:
                return 'NOTICE';
                break;

            case 6:
                return 'INFO';
                break;

            case 7:
                return 'DEBUG';
                break;

            default:
                break;
        }
    }

    /**
     * Get client ip
     * 
     * @return string
     */
    protected function getIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
        }
    }
}
