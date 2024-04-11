<?php
require_once 'C:\xampp\htdocs\TO_DO\TodoController.php';
require_once 'C:\xampp\htdocs\TO_DO\TodoImpl.php';

use PHPUnit\Framework\TestCase;

class TodoControllerTest extends TestCase {
    private $todo;
    private $controller;

    protected function setUp(): void {
        $this->todo = $this->createMock(ToDo::class);
        $this->controller = new TodoController($this->todo);
    }

    public function testProcessRequestGetAll() {
      $output=  $this->todo->method('getAll')->willReturn([]);
        $expected=$this->expectOutputString('[]');
        $this->controller->processRequest('GET', null);
      
    }

    public function testProcessRequestGetById() {
        $this->todo->method('getById')->willReturn(['id' => 1, 'name' => 'Task']);
        $this->expectOutputString(json_encode(['id' => 1, 'name' => 'Task']));
        $this->controller->processRequest('GET', '1');
    }

    public function testProcessRequestPost() {
        $this->todo->method('create')->willReturn(true);
        $this->expectOutputString('true');
        $this->controller->processRequest('POST', null);
    }

    public function testProcessRequestPut() {
        $this->todo->method('update')->willReturn(true);
        $this->expectOutputString('true');
        $this->controller->processRequest('PUT', '1');
    }

    public function testProcessRequestDelete() {
        $this->todo->method('delete')->willReturn(true);
        $this->expectOutputString('true');
        $this->controller->processRequest('DELETE', '1');
    }

    
}