<?php
set_include_path( dirname(__FILE__).'/../evernote-sdk-php/lib' . PATH_SEPARATOR . dirname(__FILE__) . PATH_SEPARATOR . get_include_path() );

require_once 'Evernote/Client.php';
require_once 'packages/NoteStore/NoteStore.php';
require_once 'packages/NoteStore/NoteStore_types.php';

require_once 'ServiceBroker.php';

$config = json_decode( file_get_contents( dirname(__FILE__) . '/../config.json' ) );

$client = new Evernote\Client( array( "token" => $config->token ) );
ServiceBroker::set("EvernoteClient", $client);
ServiceBroker::set("NoteStore", $client->getNotestore());

