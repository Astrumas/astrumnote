<?php

require_once 'Note.php';

class Notebook {

    public function __construct($raw_details) {
        $this->noteManager = ServiceBroker::get("NoteManager");
        $this->name = $raw_details->name;
        $this->guid = $raw_details->guid;
    }

    public function getNotes() {
        return $this->noteManager->getNotesForNotebook($this);
    }

}
