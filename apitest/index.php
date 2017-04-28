<?php
/**
 * Created by PhpStorm.
 * User: ludo
 * Date: 21/04/2017
 * Time: 10:26
 */
use Phalcon\Mvc\Micro;
use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use Phalcon\Http\Response;

// Loader() Autoloads the models
$loader = new Loader();

$loader->registerDirs(
    array(
        __DIR__ . '/app/models/'
    )
)->register();

$di = new FactoryDefault();

// Set up database connection
$di->set('db', function () {
    return new PdoMysql(
        array(
            "host"			=>		"localhost",
            "username"		=>		"pxluser",
            "password"		=>		"KKRuA3YFxIeQw!",
            "dbname"		=>		"projectWeb2"
        )
    );
});

// Bind the DI object to the application
$app = new Micro($di);

// Retrieves all persons
$app->get(
    "/api/persons",
    function () use ($app) {
        $phql = "SELECT * FROM person ORDER BY person_id";

        $persons = $app->modelsManager->executeQuery($phql);

        $data = [];

        foreach ($persons as $person) {
            $data[] = [
                "person_id"   => $person->person_id,
                "first_name" => $person->first_name,
                "last_name" => $person->last_name,
            ];
        }

        echo json_encode($data);
    }
);

// Retrieves persons based on person_id
$app->get(
    "/api/persons/{person_id:[0-9]+}",
    function ($person_id) use ($app) {
        $phql = "SELECT * FROM person WHERE person_id = :person_id:";

        $person = $app->modelsManager->executeQuery(
            $phql,
            [
                "person_id" => $person_id,
            ]
        )->getFirst();


        // Create a response
        $response = new Response();

        if ($person === false) {
            $response->setJsonContent(
                [
                    "status" => "NOT-FOUND"
                ]
            );
        } else {
            $response->setJsonContent(
                [
                    "status" => "FOUND",
                    "data"   => [
                        "person_id"   => $person->person_id,
                        "first_name" => $person->first_name,
                        "last_name" => $person->last_name,
                    ]
                ]
            );
        }

        return $response;
    }
);

// Retrieves persons with $first_name in their first name
$app->get(
    "/api/persons/first_name/{name}",
    function ($name) use ($app) {
        $phql = "SELECT * FROM person WHERE first_name LIKE :name: ORDER BY person_id";

        $persons = $app->modelsManager->executeQuery(
            $phql,
            [
                "name" => "%" . $name . "%"
            ]
        );

        $data = [];

        foreach ($persons as $person) {
            $data[] = [
                "person_id"   => $person->person_id,
                "first_name" => $person->first_name,
                "last_name" => $person->last_name,
            ];
        }

        echo json_encode($data);
    }
);

// Retrieves persons with $last_name in their last name
$app->get(
    "/api/persons/last_name/{name}",
    function ($name) use ($app) {
        $phql = "SELECT * FROM person WHERE last_name LIKE :name: ORDER BY person_id";

        $persons = $app->modelsManager->executeQuery(
            $phql,
            [
                "name" => "%" . $name . "%"
            ]
        );

        $data = [];

        foreach ($persons as $person) {
            $data[] = [
                "person_id"   => $person->person_id,
                "first_name" => $person->first_name,
                "last_name" => $person->last_name,
            ];
        }

        echo json_encode($data);
    }
);

// Retrieves persons with first_name and last_name
$app->get(
    "/api/persons/name/{first_name}/{last_name}",
    function ($first_name, $last_name) use ($app) {
        $phql = "SELECT * FROM person WHERE first_name = :first_name: AND last_name = :last_name: ORDER BY person_id";

        $person = $app->modelsManager->executeQuery(
            $phql,
            [
                "first_name" => $first_name,
                "last_name" => $last_name,
            ]
        )->getFirst();


        // Create a response
        $response = new Response();

        if ($person === false) {
            $response->setJsonContent(
                [
                    "status" => "NOT-FOUND"
                ]
            );
        } else {
            $response->setJsonContent(
                [
                    "status" => "FOUND",
                    "data"   => [
                        "person_id"   => $person->person_id,
                        "first_name" => $person->first_name,
                        "last_name" => $person->last_name,
                    ]
                ]
            );
        }

        return $response;
    }
);

// Adds a new person
$app->post(
    "/api/persons",
    function () use ($app) {
        $person = $app->request->getJsonRawBody();

        $phql = "INSERT INTO person (person_id,first_name, last_name) VALUES (:person_id:,:first_name:, :last_name:)";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                "person_id" => $person->person_id,
                "first_name" => $person->first_name,
                "last_name" => $person->last_name,
            ]
        );

        // Create a response
        $response = new Response();

        // Check if the insertion was successful
        if ($status->success() === true) {
            // Change the HTTP status
            $response->setStatusCode(201, "Created");

            //$person->person_id = $status->getModel()->person_id;

            $response->setJsonContent(
                [
                    "status" => "OK",
                    "data"   => $person
                ]
            );
        } else {
            // Change the HTTP status
            $response->setStatusCode(409, "Conflict");

            // Send errors to the client
            $errors = [];

            foreach ($status->getMessages() as $message) {
                $errors[] = $message->getMessage();
            }

            $response->setJsonContent(
                [
                    "status"   => "ERROR",
                    "messages" => $errors,
                ]
            );
        }

        return $response;
    }
);


// Updates persons based on person_id
$app->put(
    "/api/persons/{person_id:[0-9]+}",
    function ($person_id) use ($app) {
        $person = $app->request->getJsonRawBody();

        $phql = "UPDATE person SET first_name = :first_name:, last_name = :last_name: WHERE person_id = :person_id:";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                "person_id"   => $person_id,
                "first_name" => $person->first_name,
                "last_name" => $person->last_name,
            ]
        );

        // Create a response
        $response = new Response();

        // Check if the insertion was successful
        if ($status->success() === true) {
            $response->setJsonContent(
                [
                    "status" => "OK"
                ]
            );
        } else {
            // Change the HTTP status
            $response->setStatusCode(409, "Conflict");

            $errors = [];

            foreach ($status->getMessages() as $message) {
                $errors[] = $message->getMessage();
            }

            $response->setJsonContent(
                [
                    "status"   => "ERROR",
                    "messages" => $errors,
                ]
            );
        }

        return $response;
    }
);


// Deletes persons based on person_id
$app->delete(
    "/api/persons/{person_id:[0-9]+}",
    function ($person_id) use ($app) {
        $phql = "DELETE FROM person WHERE person_id = :person_id:";

        $status = $app->modelsManager->executeQuery(
            $phql,
            [
                "person_id" => $person_id,
            ]
        );

        // Create a response
        $response = new Response();

        if ($status->success() === true) {
            $response->setJsonContent(
                [
                    "status" => "OK"
                ]
            );
        } else {
            // Change the HTTP status
            $response->setStatusCode(409, "Conflict");

            $errors = [];

            foreach ($status->getMessages() as $message) {
                $errors[] = $message->getMessage();
            }

            $response->setJsonContent(
                [
                    "status"   => "ERROR",
                    "messages" => $errors,
                ]
            );
        }

        return $response;
    }
);

$app->notFound( function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'This is crazy, but the page you were looking for does not exist.';
});

$app->handle();