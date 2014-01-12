<?php

require_once 'Note.php';

class Notebook {

    public function __construct($raw_details) {
        $this->name = $raw_details->name;
        $this->guid = $raw_details->guid;
    }

}
