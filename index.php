<?php
session_start();

require 'config.php';
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

spl_autoload_register(function ($class) {
    if (file_exists('controllers/' . $class . '.php')) {
        require_once 'controllers/' . $class . '.php';
    } elseif (file_exists('models/' . $class . '.php')) {
        require_once 'models/' . $class . '.php';
    } elseif (file_exists('core/' . $class . '.php')) {
        require_once 'core/' . $class . '.php';
    }
});

// create a log channel
$log = new Logger('monolog');
$log->pushHandler(new StreamHandler('log.txt', Logger::WARNING));

$log->addError("Ocorreu um Erro");

$core = new Core();
$core->run();

?>
