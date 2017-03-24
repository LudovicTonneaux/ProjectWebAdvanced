<?php
/**
 * Created by PhpStorm.
 * User: Davide Pavone
 * Date: 24/03/2017
 * Time: 16:28
 */
$url = parse_url(trim($_SERVER['REQUEST_URI']));
$pathSegments = array_values(
  array_filter(explode('/', $url['path'])));
$method = $_SERVER['REQUEST_METHOD'];
$requestBody = file_get_contents('php://input');

if ($method == 'GET'){
    if (isset($pathSegments[3])){
        $eventID = $pathSegments[3];

    }
}