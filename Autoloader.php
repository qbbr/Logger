<?php
/**
 * Autoloads Q_Logger classes
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Logger_Autoloader
{
    static public function register()
    {
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        spl_autoload_register(array(new self, 'autoload'));
    }

    /**
     * Автозагрузка классов
     *
     * @param string $class Название класса
     */
    static public function autoload($class)
    {
        if (0 !== strpos($class, 'Q_Logger')) {
            return;
        }

        if ($class == 'Q_Logger') {
            $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Logger.php';
        } else {
            $file = dirname(dirname(__FILE__))  . DIRECTORY_SEPARATOR
                  . str_replace('_', DIRECTORY_SEPARATOR, str_replace('Q_', '', $class)) . '.php';
        }

        if (file_exists($file)) {
            require $file;
        }
    }
}