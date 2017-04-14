<?php

namespace view;

class PersonJsonView implements View
{
    public function show(array $data)
    {
        header('Content-Type: application/json');

        if (isset($data['person'])) {
            $person = $data['person'];
            echo json_encode(['id' => $person->getId(), 'name' => $person->getName()]);
        } else {
            echo '{}';
        }
    }
}
