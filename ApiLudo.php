<?php
/**
 * Created by PhpStorm.
 * User: ludo
 * Date: 10/05/2017
 * Time: 15:58
 */

//$xml = simplexml_load_file("configDatabank_wp6.xml");// or die("Error: Cannot create xml object");

//$user = $xml->Login->Username->__toString();
//$password = $xml->Login->Password->__toString();
//$database = $xml->Login->DatabaseName->__toString();

$user = 'root';
$password = 'user';
$database = 'ProjectWebAdvanced';

//$hostname = $xml->Login->Hostname->__toString();

$pdo = null;

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database",
        $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);


    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            //Get event by person_id and date
            if (isset($_GET['table']) AND isset($_GET['person_id']) AND isset($_GET['from']) AND isset($_GET['until']) AND $_GET['table'] == "event") {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE person_id = ' . $_GET['person_id'] . ' AND date BETWEEN \'' . $_GET['from'] . '\' AND \'' . $_GET['until'] . '\' ORDER BY date ASC');
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            //Get event by date
            elseif (isset($_GET['table']) AND isset($_GET['from']) AND isset($_GET['until']) AND $_GET['table'] == "event") {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE date BETWEEN \'' . $_GET['from'] . '\' AND \'' . $_GET['until'] . '\' ORDER BY date ASC');
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            //Get event by person_id
            elseif (isset($_GET['table']) AND isset($_GET['person_id']) AND $_GET['table'] == "event") {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE person_id = ' . $_GET['person_id']);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            //Get by id
            elseif (isset($_GET['table']) AND isset($_GET['id'])) {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE id = ' . $_GET['id']);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            //Get all
            elseif (isset($_GET['table'])) {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table']);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            break;
        case 'PUT':
            //event
            if (isset($_GET['table']) AND $_GET['table'] == "event" AND isset($_GET['id'])) {
                if (isset($_GET['name'])) {
                    $statement = $pdo->prepare('UPDATE ' . $_GET['table'] . ' SET name = \'' . $_GET['name'] . '\' WHERE id = ' . $_GET['id']);
                    $statement->execute();
                }
                if (isset($_GET['date'])) {
                    $statement = $pdo->prepare('UPDATE ' . $_GET['table'] . ' SET date = \'' . $_GET['date'] . '\' WHERE id = ' . $_GET['id']);
                    $statement->execute();
                }
                if (isset($_GET['person_id'])) {
                    $statement = $pdo->prepare('UPDATE ' . $_GET['table'] . ' SET person_id = \'' . $_GET['person_id'] . '\' WHERE id = ' . $_GET['id']);
                    $statement->execute();
                }
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE id = ' . $_GET['id']);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            //person
            elseif (isset($_GET['table']) AND $_GET['table'] == "person" AND isset($_GET['id'])) {
                if (isset($_GET['first_name'])) {
                    $statement = $pdo->prepare('UPDATE ' . $_GET['table'] . ' SET first_name = \'' . $_GET['first_name'] . '\' WHERE id = ' . $_GET['id']);
                    $statement->execute();
                }
                if (isset($_GET['last_name'])) {
                    $statement = $pdo->prepare('UPDATE ' . $_GET['table'] . ' SET last_name = \'' . $_GET['last_name'] . '\' WHERE id = ' . $_GET['id']);
                    $statement->execute();
                }
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE id = ' . $_GET['id']);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            break;
        case 'POST':
            if (isset($_GET['table']) AND $_GET['table'] == "event")
            {

                if (isset($_GET['name']) AND $_GET['name'] == NULL) {
                    echo 'You have to set a value for name';
                    break;
                }
                else if (isset($_GET['date']) AND $_GET['date'] == NULL) {
                    echo 'You have to set a value for date';
                    break;
                }
                else if (isset($_GET['person_id']) AND $_GET['person_id'] == NULL) {
                    echo 'You have to set a value for person_id';
                    break;
                }
                else {
                    $statement = $pdo->prepare('INSERT INTO ' . $_GET['table'] . ' (id, name, date, person_id) VALUES (NULL, ' . '\'' . $_GET['name'] . '\', ' . '\'' . $_GET['date'] . '\', ' . $_GET['person_id'] . ') ');
                    $statement = $pdo->prepare('INSERT INTO ' . $_POST['table'] . ' (id, name, date, person_id) VALUES (NULL, ' . '\'' . $_POST['name'] . '\', ' . '\'' . $_POST['date'] . '\', ' . $_POST['person_id'] . ')');
                    $statement->execute();
                    $statement->debugDumpParams();
                    break;
                }
            }
            else if (isset($_GET['table']) AND $_GET['table'] == "person") {
                if (isset($_GET['first_name']) AND $_GET['first_name'] == NULL) {
                    echo 'You have to set a value for first_name';
                    break;
                }
                else if (isset($_GET['last_name']) AND $_GET['last_name'] == NULL) {
                    echo 'You have to set a value for last_name';
                    break;
                }
                else {
                    $statement = $pdo->prepare('INSERT INTO ' . $_GET['table'] . ' (id, first_name, last_name) VALUES (NULL, ' . '\'' . $_GET['first_name'] . '\', ' . '\'' . $_GET['last_name'] . '\')');
                    $statement = $pdo->prepare('INSERT INTO ' . $_POST['table'] . ' (id, first_name, last_name) VALUES (NULL, ' . '\'' . $_POST['first_name'] . '\', ' . '\'' . $_POST['last_name'] . '\')');
                    $statement->execute();
                    $statement->debugDumpParams();
                    break;
                }
            }
            else {
                echo 'the table ' . $_GET['table'] . ' is not supported';
                break;
            }
        case 'DELETE':
        if (isset($_GET['table']) AND isset($_GET['id'])) {
            $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE id = ' . $_GET['id']);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            $statement = $pdo->prepare('DELETE from ' . $_GET['table'] . ' WHERE id = ' . $_GET['id']);
            $statement->execute();
            echo $json . ' has been deleted!';
    }
            break;
    }
} catch (PDOException $e) {
    print 'Exception!: ' . $e->getMessage();
} finally {
    $pdo = null;
}