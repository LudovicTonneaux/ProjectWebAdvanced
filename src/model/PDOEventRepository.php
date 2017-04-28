<?php

namespace model;

class PDOEventRepository implements EventsRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findEventById($id )
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM events WHERE eventID=?');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return new Events($results[0]['eventID'], $results[0]['datum']);
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }
}
