<?php
interface taskManagerInterface {
    public function addTask($description);
    public function getTasks();
    public function updateTask($index, $description);
    public function deleteTask($index);
}
?>
