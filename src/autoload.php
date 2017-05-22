<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19/05/2017
 * Time: 16:43
 */

if (!function_exists('classAutoLoader')) {
    function classAutoLoader($className)
    {
        $fileName = 'src/'.
            str_replace('\\', '/', $className).
            '.php';
        require_once $fileName;
    }
}
spl_autoload_register('classAutoLoader');