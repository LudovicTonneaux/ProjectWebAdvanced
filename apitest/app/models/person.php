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


class person extends Model
{

    // Columns
    public $person_id;
    public $first_name;
    public $last_name;

    // Validations
    public function validation(){


        // first_name is required
        $this->validate(
            new PresenceOf(
                array(
                    "field"		=>	"first_name",
                    "message"	=>	"The first_name is required."
                )
            )
        );

        // slast_name is required
        $this->validate(
            new PresenceOf(
                array(
                    "field"		=>	"last_name",
                    "message"	=>	"The last_name is required."
                )
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}