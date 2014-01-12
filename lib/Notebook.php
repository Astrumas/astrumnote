<?php

require_once 'Note.php';

class Notebook {

    public function __construct($raw_data) {
        $this->noteManager = ServiceBroker::get("NoteManager");
        $this->raw_data = $raw_data;
        $this->name = $raw_data->name;
        $this->guid = $raw_data->guid;
    }

    public function getNotes() {
        return $this->noteManager->getNotesForNotebook($this);
    }

}
