<?php
// require_once 'taskInterface.php';
require_once 'TaskManagerInterface.php';

class TaskManager implements taskManagerInterface {
    private $taskRepository;

    public function __construct(taskInterface $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function addTask($description) {
        $this->taskRepository->addTask($description);
    }

    public function getTasks() {
        return $this->taskRepository->getAllTask();
    }

    public function updateTask($index, $description) {
        $this->taskRepository->updateTask($index, $description);
    }

    public function deleteTask($index) {
        $this->taskRepository->deleteTask($index);
    }
}
?>
