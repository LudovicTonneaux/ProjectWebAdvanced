<?php

namespace view;

class EventJsonView implements View
{
    public function show(array $data)
    {
        header('Content-Type: application/json');

        if (isset($data['event'])) {
            $event = $data['event'];
            echo json_encode(['eventId' => $event->getId(), 'datum' => $event->getDate()]);
        } else {
            echo '{}';
        }
    }
}
