<?php

class NoteManager {

    public function __construct() {
        $this->noteStore = ServiceBroker::get("NoteStore");
    }

    public function getNotesForNotebook($notebook) {
        $filter = ServiceBroker::get("NoteFilter");
        $filter->notebookGuid = $notebook->guid;
        return $this->getNotes($filter);
    }

    private function getNotes($filter) {
        $resultSpec = ServiceBroker::get("NotesMetadataResultSpec");
        $resultSpec->includeTitle = true;

        $noteList = $this->noteStore->findNotesMetadata($filter, 0, 100, $resultSpec);

        $notes = array();
        foreach( $noteList->notes as $raw_note ) {
            $note = $this->noteStore->getNote($raw_note->guid, true, false, false ,false );
            $notes[] = new Note($note);
        }

        return $notes;
    }

}
