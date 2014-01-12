<?php

require_once dirname(__FILE__) . '/../bootstrap.php';
require_once dirname(__FILE__) . '/../../lib/NoteManager.php';

class NoteManagerTest extends PHPUnit_Framework_TestCase {
    
    public function setUp() {
        $this->notestore_mock = $this->getMock('StubClass', array( 'findNotesMetaData', 'getNote' ));
        ServiceBroker::set("NoteStore", $this->notestore_mock);

        $this->noteresultspec_mock = $this->getMock('StubClass');
        ServiceBroker::set("NotesMetadataResultSpec", $this->noteresultspec_mock);

        $this->notefilter_mock = $this->getMock('StubClass');
        ServiceBroker::set("NoteFilter", $this->notefilter_mock);

        $this->note_manager = new NoteManager();
    }

    public function testGetNotesForNotebook() {
        $noteList = new StubClass();
        $noteList->notes = array(
               (object)array( "guid" => "123abc" ), 
               (object)array( "guid" => "456def" )
        );

        $this->notestore_mock->expects($this->once())
            ->method('findNotesMetaData')
            ->with( $this->notefilter_mock, 0, 100, $this->noteresultspec_mock )
            ->will($this->returnValue($noteList));

        $this->notestore_mock->expects($this->at(1))
            ->method('getNote')
            ->with($noteList->notes[0]->guid);

        $this->notestore_mock->expects($this->at(2))
            ->method('getNote')
            ->with($noteList->notes[1]->guid);

        $this->note_manager->getNotesForNotebook( (object)array("guid" => "notebook_guid") );
    }

}
