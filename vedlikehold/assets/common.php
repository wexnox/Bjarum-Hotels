<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 05.01.2017
 * Time: 07.01
 */
function autoload($class) {
    $class = ucfirst($class);
    include 'classes/' .$class . '.class.php';
}

spl_autoload_register('autoload');