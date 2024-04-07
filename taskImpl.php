<?php
require_once "taskEntity.php";

class taskImpl implements taskInterface{
    private $tasks=[];
    public function addTask($description){
        $this->tasks=$description;
        return true;
    }

    public function getAllTask(){
    return $this->tasks;
    }

    public function updateTask($index, $description){
        if(isset($this->tasks[$index]))
        {
            $this->tasks[$index]->setDescription($description);
            return true;
        }
        return false;
        
    }

    public function deleteTask($index){
        if (isset($this->tasks[$index])) {
            array_splice($this->tasks, $index, 1);
            return true;
        }
        return false;
        
    }

    public function getTask($index){
        return isset($this->tasks[$index]) ? $this->tasks[$index] : null;
        
    }

}

?>