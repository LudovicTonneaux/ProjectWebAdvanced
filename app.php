<?php
/**
 * Created by PhpStorm.
 * User: Davide Pavone
 * Date: 14/04/2017
 * Time: 10:35
 */
require_once 'src/autoload.php';
use \controller\PersonController;
use \controller\EventsController;
use \model\PDOPersonRepository;
use \model\PDOEventRepository;
use \view\PersonJsonView;
use \view\EventJsonView;

$user = 'pxluser';
$password = 'KKRuA3YFxIeQw!';
$database = 'projectWeb';
$pdo = null;

try{
    $pdo = new PDO("mysql:host=localhost;dbname=$database",
                        $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);

    $personPDORepository = new PDOPersonRepository($pdo);
    $eventPDORepository = new PDOEventRepository($pdo);
    $personJsonView = new PersonJsonView();
    $eventJsonView = new EventJsonView();
    $personController = new PersonController($personPDORepository, $personJsonView);
    $eventController = new EventsController($eventPDORepository, $eventJsonView);

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $personController->handleFindPersonById($id);
    $eventController->handleFindEventById($id);
}catch (Exception $e){
    echo 'Cannot connect to the database!';
}