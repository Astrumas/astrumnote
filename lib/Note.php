<?php

class Note {

    public function __construct($raw_data) {
        $this->raw_data = $raw_data;
        $this->title = $raw_data->title;
        $this->guid = $raw_data->guid;
        $this->content = $raw_data->content;
    }

}
