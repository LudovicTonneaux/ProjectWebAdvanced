<?php

namespace controller;




class EventsControllerTest extends PHPUnit\Framework\Testcase
{
    private $pdo = null;

    public function setUP()
    {
        try {
        $xml = simplexml_load_file("configDatabank_wp6.xml");// or die("Error: Cannot create xml object");

        $user = $xml->Login->Username->__toString();
        $password = $xml->Login->Password->__toString();
        $database = $xml->Login->DatabaseName->__toString();

        $hostname = $xml->Login->Hostname->__toString();

        $pdo = new PDO("mysql:host=$hostname;dbname=$database",
            $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            print 'Exception!: ' . $e->getMessage();
        } finally {
            $pdo = null;
        }
    }

    public function tearDown()
    {
        $pdo = null;
    }


    /** @test */
    public function TestGetEventByPerson_idAndDate()
    {
        $person_id = 2;
        $date1 = "2011-01-01";
        $date2 = "2013-01-01";

        $statement = $this->pdo->prepare('SELECT * from event WHERE person_id = ' . $person_id . ' AND date BETWEEN ' .$date1 . ' AND ' . $date2 . ' ORDER BY date ASC');
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNotNull($results);
    }

    /** @test */
    public function TestGetEventByDate()
    {
        $date1 = "2011-01-01";
        $date2 = "2013-01-01";

        $statement = $this->pdo->prepare('SELECT * from event WHERE date BETWEEN ' . $date1 . ' AND ' . $date2 .' ORDER BY date ASC');
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNotNull($results);
    }

    /** @test */
    public function TestGetEventByPerson_id()
    {
        $person_id = 2;

        $statement = $this->pdo->prepare('SELECT * from event WHERE person_id = ' . $person_id . ' ORDER BY date ASC');
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNotNull($results);
    }

    /** @test */
    public function TestGetEventById()
    {
        $id = 1;

        $statement = $this->pdo->prepare('SELECT * from event WHERE id = ' . $id . ' ORDER BY date ASC');
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNotNull($results);
    }

    public function TestGetAll()
    {
        $statement = $this->pdo->prepare('SELECT * from event WHERE ORDER BY date ASC');
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNotNull($results);
    }

    public function TestPutEventname()
    {
        $name = "test";
        $id = 1;

        $statement = $this->pdo->prepare('UPDATE event SET name = ' . $name . '  WHERE id = ' . $id);
        $statement->execute();

        $statement2 = $this->pdo->prepare('SELECT name FROM event WHERE id = ' . $id);
        $statement2->execute();
        $result = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $this->assertEqual($name,$result);

    }

    public function TestPutEventdate()
    {
        $date = "2000-01-01";
        $id = 1;

        $statement = $this->pdo->prepare('UPDATE event SET date = ' . $date . '  WHERE id = ' . $id);
        $statement->execute();

        $statement2 = $this->pdo->prepare('SELECT date FROM event WHERE id = ' . $id);
        $statement2->execute();
        $result = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $this->assertEqual($date,$result);

    }

    public function TestPutEventPerson_id()
    {
        $person_id = 10;
        $id = 1;

        $statement = $this->pdo->prepare('UPDATE event SET person_id = ' . $person_id . '  WHERE id = ' . $id);
        $statement->execute();

        $statement2 = $this->pdo->prepare('SELECT person_id FROM event WHERE id = ' . $id);
        $statement2->execute();
        $result = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $this->assertEqual($person_id,$result);

    }

    public function TestPutPersonFirstName()
    {
        $firstname = "test";
        $id = 1;

        $statement = $this->pdo->prepare('UPDATE person SET first_name = ' . $firstname . '  WHERE id = ' . $id);
        $statement->execute();

        $statement2 = $this->pdo->prepare('SELECT first_name FROM person  WHERE id = ' . $id);
        $statement2->execute();
        $result = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $this->assertEqual($firstname,$result);

    }

    public function TestPutPersonLastName()
    {
        $lastname = "test";
        $id = 1;

        $statement = $this->pdo->prepare('UPDATE person SET last_name = ' . $lastname . '  WHERE id = ' . $id);
        $statement->execute();

        $statement2 = $this->pdo->prepare('SELECT last_name FROM person WHERE id = ' . $id);
        $statement2->execute();
        $result = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $this->assertEqual($lastname,$result);

    }

    public function TestPostEvent()
    {

        $statement2 = $this->pdo->prepare('SELECT name FROM event');
        $statement2->execute();
        $result = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $size1 = $result.size;

        $date = "2000-01-01";
        $name = "test";
        $person_id = 10;

        $statement = $this->pdo->prepare('INSERT INTO ' . $_GET['table'] . ' (id, name, date, person_id) VALUES (NULL, ' . $name . ',' . $date . ',' . $person_id . ') ');
        $statement->execute();
        $statement->debugDumpParams();

        $statement2 = $this->pdo->prepare('SELECT name FROM event');
        $statement2->execute();
        $result = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $size2 = $result.size;

        $this->assertEqual($size1,$size2-1);

    }

    public function TestPostPerson()
    {
        $statement2 = $this->pdo->prepare('SELECT first_name FROM person');
        $statement2->execute();
        $result = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $size1 = $result.size;

        $first_name = "test";
        $last_name = "test";

        $statement = $this->pdo->prepare('INSERT INTO ' . $_GET['table'] . ' (id, first_name, last_name) VALUES (NULL, ' . $first_name . ',' . $last_name . ') ');
        $statement->execute();
        $statement->debugDumpParams();

        $statement2 = $this->pdo->prepare('SELECT name FROM person');
        $statement2->execute();
        $result = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $size2 = $result.size;

        $this->assertEqual($size1,$size2-1);

    }

    public function TestDeleteEvent()
    {
        $id = 1;

        $statement = $this->pdo->prepare('DELETE from event WHERE id = ' . $id);
        $statement->execute();

        $statement2 = $this->pdo->prepare('SELECT * FROM event WHERe id = ' . $id);
        $statement2->execute();
        $result = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNull($result);

    }

    public function TestDeletePerson()
    {
        $id = 1;

        $statement = $this->pdo->prepare('DELETE from person WHERE id = ' . $id);
        $statement->execute();

        $statement2 = $this->pdo->prepare('SELECT * FROM person WHERe id = ' . $id);
        $statement2->execute();
        $result = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNull($result);
    }







}
