<?php

require_once 'Notebook.php';

class NotebookManager_NotebookNotFoundException extends Exception {}

class NotebookManager {

    public function __construct($notestore) {
        $this->notestore = $notestore;
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
        $raw_notebooks = $this->notestore->listNotebooks();
        foreach( $raw_notebooks as $raw_notebook ) {
            $notebooks[] = new NoteBook($raw_notebook);
        }

        return $notebooks;
    }
}
