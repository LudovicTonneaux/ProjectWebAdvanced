<?php

/**
 * Created by PhpStorm.
 * User: ludo
 * Date: 21/04/2017
 * Time: 09:54
 */
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\Regex;


class events extends Model
{

    // Columns
    public $event_id;
    public $name;
    public $person_id;
    public $date;

    // Validations
    public function validation(){

        // name is required
        $this->validate(
            new PresenceOf(
                array(
                    "field"		=>	"name",
                    "message"	=>	"The name is required."
                )
            )
        );

        // person_id is required
        $this->validate(
            new PresenceOf(
                array(
                    "field"		=>	"person_id",
                    "message"	=>	"The person_id is required."
                )
            )
        );

        // date is required
        $this->validate(
            new PresenceOf(
                array(
                    "field"		=>	"date",
                    "message"	=>	"The date is required."
                )
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}