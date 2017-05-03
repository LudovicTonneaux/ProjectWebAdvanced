<?php
/**
 * Created by PhpStorm.
 * User: Davide Pavone
 * Date: 23/02/2017
 * Time: 14:43
 */
$user = 'pxluser';
$password = 'KKRuA3YFxIeQw!';
$database = 'projectWeb';
$pdo = null;
try {
    $pdo = new PDO("mysql:host=localhost;dbname=$database",
        $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $username = $_POST['user'];
    $password_user = $_POST['password'];
    $query = 'SELECT * FROM login WHERE username = ? ' .
        'AND password = MD5(?) ';
    $statement = $pdo->prepare($query);
    $statement->bindParam(1, $username, PDO::PARAM_INT);
    $statement->bindParam(2, $password_user, PDO::PARAM_STR);
    $statement->execute();
    $row = $statement->fetch();

    if ($row !== false) {
        echo "<p>Debug menu: <br/>username: " . $row['username'] . '<br />password: ' .
            $password_user . "<br/>encrypted password: " . $row['password'] . "</p>";
    } else {
        echo "<p style='font-weight: bold '>Login gefaald!</p>" .
            'invalid id and/or password: ' . $username . ' ' . $password_user;
    }

} catch (PDOException $e) {
    print 'Exception!: ' . $e->getMessage();
}

$pdo = null;