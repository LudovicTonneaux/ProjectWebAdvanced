<?php
/**
 * Created by PhpStorm.
 * User: ludo
 * Date: 10/05/2017
 * Time: 15:58
 */

$user='pxluser';
$password='KKRuA3YFxIeQw!';
$database='projectWeb';
$hostname = 'localhost';
$pdo = null;

try {
    $pdo = new PDO( "mysql:host=$hostname;dbname=$database",
        $user, $password );
    $pdo->setAttribute( PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION );



    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if (isset($_GET['table']) AND !isset($_GET['id']))
            {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table']);
                $statement->execute();
                $results=$statement->fetchAll(PDO::FETCH_ASSOC);
                $json=json_encode($results);
                echo $json;
            }

            elseif (isset($_GET['table']) AND isset($_GET['id']))
            {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE id = ' . $_GET['id']);
                $statement->execute();
                $results=$statement->fetchAll(PDO::FETCH_ASSOC);
                $json=json_encode($results);
                echo $json;
            }
            break;
        case 'PUT':
            if (isset($_GET['table']) AND isset($_GET['id']) AND isset($_GET['first_name']) AND isset($_GET['last_name']))
            {
                $statement = $pdo->prepare('UPDATE ' . $_GET['table'] . ' SET first_name = "' . $_GET['first_name'] . '", last_name = "' . $_GET['last_name'] . '" WHERE id = '. $_GET['id']);
                $statement->debugDumpParams();
                $statement->execute();
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE id = ' . $_GET['id']);
                $statement->execute();
                $results=$statement->fetchAll(PDO::FETCH_ASSOC);
                $json=json_encode($results);
                echo $json;
            }
            break;
        case 'POST':

            break;
        case 'DELETE':

            break;
    }
}
catch ( PDOException $e ) {
    print 'Exception!: ' . $e->getMessage();
}
finally {
    $pdo = null;
}