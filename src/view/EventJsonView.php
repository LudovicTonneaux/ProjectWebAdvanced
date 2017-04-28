<?php

namespace view;

class EventJsonView implements View
{
    public function show(array $data)
    {
        header('Content-Type: application/json');

        if (isset($data['events'])) {
            $event = $data['events'];
            echo json_encode(['eventID' => $event->getId(), 'datum' => $event->getDate()]);
        } else {
            echo '{}';
        }
    }
}
