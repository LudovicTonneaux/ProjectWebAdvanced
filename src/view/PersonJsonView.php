<?php

namespace view;

class PersonJsonView implements View
{
    public function show(array $data)
    {
        header('Content-Type: application/json');

        if (isset($data['persoon'])) {
            $persoon = $data['persoon'];
            echo json_encode(['persoonID' => $persoon->getId(), 'naam' => $persoon->getName()]);
        } else {
            echo '{}';
        }
    }
}
