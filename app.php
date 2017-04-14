<?php
/**
 * Created by PhpStorm.
 * User: Davide Pavone
 * Date: 14/04/2017
 * Time: 10:35
 */
require_once 'src/autoload.php';
//use \controller\...;
//use \model\...;
//use \view\...;

$user = 'pxluser';
$password = 'KKRuA3YFxIeQw!';
$database = 'projectWeb';
$pdo = null;

try{
    $pdo = new PDO("mysql:host=localhost;dbname=$database",
                        $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);

    //$personPDORepository = new PDOPersonRepository($pdo);
    //$personJsonView = new PersonJsonView();
    //$personController = new PersonController($personPDORepository, $personJsonView);

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    //$personController->handleFindPersonById($id);
}catch (Exception $e){
    echo 'Cannot connect to the database!';
}