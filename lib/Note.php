<?php

class Note {

    public function __construct($raw_details) {
        $this->title = $raw_details->title;
    }

}
