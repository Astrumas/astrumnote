<?php

require_once dirname(__FILE__) . '/../bootstrap.php';
require_once dirname(__FILE__) . '/../../lib/NotebookManager.php';

class NotebookManagerTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->notestore_mock = $this->getMock('StubClass', array( 'listNotebooks' ));
        $this->notebook_manager = new NotebookManager($this->notestore_mock);
        $this->test_notebooks = unserialize( file_get_contents( dirname(__FILE__) . '/../fixtures/notebooks.serialized') );
    }

    public function testGetNootbookByName() {
        $notebook_name = "Test Notebook";
        $this->notestore_mock->expects($this->once())
            ->method('listNotebooks')
            ->will($this->returnValue($this->test_notebooks));

        $notebook = $this->notebook_manager->getNotebookByName($notebook_name);

        $this->assertSame($notebook_name, $notebook->name);
    }

    public function testGetNotebookByNameThatDoesntExistThrowsException() {
        $this->notestore_mock->expects($this->once())
            ->method('listNotebooks')
            ->will($this->returnValue($this->test_notebooks));

        $this->setExpectedException('NotebookManager_NotebookNotFoundException');
        $this->notebook_manager->getNotebookByName("Test Notebook That Doesnt Exist");
    }
    
}
