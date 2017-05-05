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

$user = 'root';
$password = 'user';
$database = 'ProjectWebAdvanced';
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

//    $id = isset($_GET['id']) ? $_GET['id'] : null;
//    $personController->handleFindPersonById($id);
//    $eventController->handleFindEventById($id);


// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

// connect to the mysql database
$link = mysqli_connect('localhost', 'root', 'user', 'ProjectWebAdvanced');
mysqli_set_charset($link,'utf8');

// retrieve the table and key from the path
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$key = array_shift($request)+0;

// escape the columns and values from the input object
$columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
$values = array_map(function ($value) use ($link) {
    if ($value===null) return null;
    return mysqli_real_escape_string($link,(string)$value);
},array_values($input));

// build the SET part of the SQL command
$set = '';
for ($i=0;$i<count($columns);$i++) {
    $set.=($i>0?',':'').'`'.$columns[$i].'`=';
    $set.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
}

// create SQL based on HTTP method
switch ($method) {
    case 'GET':

       $sql = "select * from `$table`".($key?" WHERE id=$key":''); break;

        $pdo = new PDO("mysql:host=localhost;dbname=$database",
            $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("select * from  :table" . ":id WHERE id = :id");
        $sql->bindParam(':table', $table, PDO::PARAM_STR);
        $sql->bindParam(':id', $key, PDO::PARAM_INT);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        var_dump($sql->fetch());
    case 'PUT':
        $sql = "update `$table` set $set where id=$key"; break;
    case 'POST':
        $sql = "insert into `$table` set $set"; break;
    case 'DELETE':
        $sql = "delete `$table` where id=$key"; break;
}

// excecute SQL statement
$result = mysqli_query($link,$sql);

// die if SQL statement failed
if (!$result) {
    http_response_code(404);
    die(mysqli_error());
}

// print results, insert id or affected row count
if ($method == 'GET') {
    if (!$key) echo '[';
    for ($i=0;$i<mysqli_num_rows($result);$i++) {
        echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
    if (!$key) echo ']';
} elseif ($method == 'POST') {
    echo mysqli_insert_id($link);
} else {
    echo mysqli_affected_rows($link);
}

// close mysql connection
mysqli_close($link);

    // url (required), options (optional)
//    fetch('192.168.119.128/~user/ProjectWebAdvanced/app.php/persoon').then(function(response) {
//        return response.json();
//    }).then(function() {
//        console.log(j);
//        window.alert(" test ");
////        $user = 'root';
////        $password = 'user';
////        $database = 'ProjectWebAdvanced';
////        $pdo = null;
////        $pdo = new PDO("mysql:host=localhost;dbname=$database",
////            $user, $password);
////        $pdo->setAttribute(PDO::ATTR_ERRMODE,
////            PDO::ERRMODE_EXCEPTION);
////        $sql = "SELECT * FROM person";
////        foreach ($pdo->query($sql) as $row)
////        {
////            print 'id: ' .$row['id'].' |  firstname: '.$row['first_name']. ' | lastname: '.$row['last_name']. '<br/>';
////        }
//    });

    $pdo = null;
}catch (Exception $e){
    echo 'Cannot connect to the database!';
}