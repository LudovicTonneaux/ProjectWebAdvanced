<?php

namespace controller;




class EventsControllerTest extends PHPUnit\Framework\Testcase
{
    private $pdo = null;

    public function setUP()
    {
        $pdo = null;

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


}
