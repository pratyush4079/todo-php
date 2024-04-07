<?php
interface taskInterface{
    public function addTask($description);
    public function getAlltask();
    public function updateTask($index,$description);
    public function deleteTask($index);
    public function getTask($index);
    
}