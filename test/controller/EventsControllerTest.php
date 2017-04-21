<?php

namespace controller;

use model\Events;
use model\EventsRepository;
use view\View;

class EventsControllerTest extends \PHPUnit\Framework\TestCase
{
    private $mockEventsRepository;
    private $mockView;

    public function setUP()
    {
        $this->mockEventsRepository = $this->getMockBuilder('model\EventsRepository')->getMock();
        $this->mockView = $this->getMockBuilder('view\EventJsonView')->getMock();
    }

    public function tearDown()
    {
        $this->mockEventsRepository = null;
        $this->mockView = null;
    }


    /** @test */
    public function TestHandleFindEventById_eventFound_jsonFileGenerated($id = null)
    {
        $events = new Events(9, 2, 2017 - 12 - 12);
        $this->mockEventsRepository->expects($this->atLeastOnce())
            ->method('findEventById')
            ->will($this->returnValue($events));

        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object){
                $events = $object['events'];
                printf('%d %d %s', $events->getId(), $events->getPersonId(), $events->getDate());
            }));

        $eventsController = new EventsController($this->mockEventsRepository, $this->mockView);
        $eventsController->handleFindEventById($events->getId());
        $this->expectOutputString(sprintf('%d %d %s', $events->getId(), $events->getPersonId(), $events->getDate()));
    }
}
