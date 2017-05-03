<?php

namespace controller;

use model\Person;
use model\PersonRepository;
use view\View;

class PersonControllerTest extends \PHPUnit\Framework\TestCase
{
    private $mockPersonRepository;
    private $mockView;

    public function setUP()
    {
        $this->mockPersonRepository = $this->getMockBuilder('model\PersonRepository')->getMock();
        $this->mockView = $this->getMockBuilder('view\PersonJsonView')->getMock();
    }

    public function tearDown()
    {
        $this->mockPersonRepository = null;
        $this->mockView = null;
    }


    /** @test */
    public function TestHandleFindPersonById_personFound_jsonFileGenerated($id = null)
    {
        $person = new Person(9, 2, "John");
        $this->mockPersonRepository->expects($this->atLeastOnce())
            ->method('findPersonById')
            ->will($this->returnValue($person));

        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object){
                $person = $object['persoon'];
                printf('%d %d %s', $person->getId(), $person->getEventsId(), $person->getName());
            }));

        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handleFindPersonById($person->getId());
        $this->expectOutputString(sprintf('%d %d %s', $person->getId(), $person->getEventsId(), $person->getName()));
    }

    /** @test */
    public function TestHandleFindPersonByEventsId_personFound_jsonFileGenerated($eventsId = null)
    {
        $person = new Person(9, 2, "John");
        $this->mockPersonRepository->expects($this->atLeastOnce())
            ->method('findPersonById')
            ->will($this->returnValue($person));

        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object){
                $person = $object['persoon'];
                printf('%d %d %s', $person->getId(), $person->getEventsId(), $person->getName());
            }));

        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handleFindPersonById($person->getEventsId());
        $this->expectOutputString(sprintf('%d %d %s', $person->getId(), $person->getEventsId(), $person->getName()));
    }

    /** @test */
    public function TestHandleFindPersonByName_personFound_jsonFileGenerated($name = null)
    {
        $person = new Person(9, 2, "John");
        $this->mockPersonRepository->expects($this->atLeastOnce())
            ->method('findPersonById')
            ->will($this->returnValue($person));

        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $person = $object['persoon'];
                printf('%d %d %s', $person->getId(), $person->getEventsId(), $person->getName());
            }));

        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handleFindPersonById($person->getName());
        $this->expectOutputString(sprintf('%d %d %s', $person->getId(), $person->getEventsId(), $person->getName()));
    }
}
