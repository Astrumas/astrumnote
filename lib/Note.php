<?php

class Note {

    public function __construct($raw_details) {
        $this->title = $raw_details->title;
        $this->guid = $raw_details->guid;
        $this->content = $raw_details->content;
    }

}
