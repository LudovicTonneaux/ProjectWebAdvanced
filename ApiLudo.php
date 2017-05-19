<?php
/**
 * Created by PhpStorm.
 * User: ludo
 * Date: 10/05/2017
 * Time: 15:58
 */

$xml = simplexml_load_file("configDatabank_wp6.xml");// or die("Error: Cannot create xml object");

$user = $xml->Login->Username->__toString();
$password = $xml->Login->Password->__toString();
$database = $xml->Login->DatabaseName->__toString();

$hostname = $xml->Login->Hostname->__toString();

$pdo = null;

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database",
        $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);


    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':

            if ($_GET['table'] != "event" OR $_GET['table'] != "person") {
                echo "the table must be event or person";
                break;
            }

            //Get event by person_id and date
            elseif ($_GET['table'] AND $_GET['person_id'] AND $_GET['from'] AND $_GET['until'] AND $_GET['table'] == "event") {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE person_id = ' . $_GET['person_id'] . ' AND date BETWEEN \'' . $_GET['from'] . '\' AND \'' . $_GET['until'] . '\' ORDER BY date ASC');
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            //Get event by date
            elseif ($_GET['table'] AND $_GET['from'] AND $_GET['until'] AND $_GET['table'] == "event") {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE date BETWEEN \'' . $_GET['from'] . '\' AND \'' . $_GET['until'] . '\' ORDER BY date ASC');
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            //Get event by person_id
            elseif ($_GET['table'] AND $_GET['person_id'] AND $_GET['table'] == "event") {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE person_id = ' . $_GET['person_id']);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            //Get by id
            elseif ($_GET['table'] AND $_GET['id']) {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table'] . ' WHERE id = ' . $_GET['id']);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            //Get all
            elseif ($_GET['table']) {
                $statement = $pdo->prepare('SELECT * from ' . $_GET['table']);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
            }
            break;
        case 'PUT':
            //event
            if ($_GET['table'] AND $_GET['table'] == "event" AND $_GET['id']) {
                if ($_GET['name']) {
                    $statement = $pdo->prepare('UPDATE ' . $_GET['table'] . ' SET name = \'' . $_GET['name'] . '\' WHERE id = ' . $_GET['id']);
                    $statement->execute();
                }
                if ($_GET['date']) {
                    $statement = $pdo->prepare('UPDATE ' . $_GET['table'] . ' SET date = \'' . $_GET['date'] . '\' WHERE id = ' . $_GET['id']);
                    $statement->execute();
                }
                if ($_GET['person_id']) {
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
            elseif ($_GET['table'] AND $_GET['table'] == "person" AND $_GET['id']) {
                if ($_GET['first_name']) {
                    $statement = $pdo->prepare('UPDATE ' . $_GET['table'] . ' SET first_name = \'' . $_GET['first_name'] . '\' WHERE id = ' . $_GET['id']);
                    $statement->execute();
                }
                if ($_GET['last_name']) {
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
            if ($_GET['table'] AND $_GET['table'] == "event")
            {

                if (!$_GET['name']) {
                    echo 'You have to set a value for name';
                    break;
                }
                else if (!$_GET['date']) {
                    echo 'You have to set a value for date';
                    break;
                }
                else if (!$_GET['person_id']) {
                    echo 'You have to set a value for person_id';
                    break;
                }
                else {
                    $statement = $pdo->prepare('INSERT INTO ' . $_GET['table'] . ' (id, name, date, person_id) VALUES (NULL, ' . '\'' . $_GET['name'] . '\', ' . '\'' . $_GET['date'] . '\', ' . $_GET['person_id'] . ') ');
                    $statement->execute();
                    $statement->debugDumpParams();
                    break;
                }
            }
            else if ($_GET['table'] AND $_GET['table'] == "person") {
                if (!$_GET['first_name']) {
                    echo 'You have to set a value for first_name';
                    break;
                }
                else if (!$_GET['last_name']) {
                    echo 'You have to set a value for last_name';
                    break;
                }
                else {
                    $statement = $pdo->prepare('INSERT INTO ' . $_GET['table'] . ' (id, first_name, last_name) VALUES (NULL, ' . '\'' . $_GET['first_name'] . '\', ' . '\'' . $_GET['last_name'] . '\')');
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
            if ($_GET['table'] AND $_GET['id']) {
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