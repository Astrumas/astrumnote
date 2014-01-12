<?php

require_once 'Notebook.php';

class NotebookManager_NotebookNotFoundException extends Exception {}

class NotebookManager {

    public function __construct() {
        $this->noteStore = ServiceBroker::get("NoteStore");
    }

    public function getNotebookByName($name) {
        $notebooks = $this->getNotebooks();

        foreach( $notebooks as $notebook ) {
            if( $notebook->name == $name ) {
                return $notebook;
            }
        }

        throw new NotebookManager_NotebookNotFoundException("Notebook '{$name}' not found.");
    }

    private function getNotebooks() {
        $notebooks = array();
        $raw_notebooks = $this->noteStore->listNotebooks();
        foreach( $raw_notebooks as $raw_notebook ) {
            $notebooks[] = new Notebook($raw_notebook);
        }

        return $notebooks;
    }

}
