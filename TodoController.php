<?php
require_once "ToDo.php";

class TodoController
{
    public function __construct(private ToDo $toDo ){}
    public function processRequest (string $method , ?string $id):void
    {
        if ($id) {
            $this->processTodoTask($method, $id);
        }
        else{
            $this->processRequestTodo($method);
        }
    }
    private function processTodoTask($method, $id):void
    {
        switch($method){
            case 'GET':
                $todotask = $this->toDo->getById($id);
                echo json_encode($todotask);
                break;
            case 'PUT':
                $data = json_decode(file_get_contents('php://input'), true);
                $result = $this->toDo->update($id, $data);
                echo json_encode($result);
                break;
            case 'DELETE':
                $result = $this->toDo->delete($id);
                echo json_encode($result);
                break;    
            default:
                http_response_code(405);
                header("Allow: GET, PUT");
        }
    }
    private function processRequestTodo($method): void
    {
        switch($method){
            case 'GET':
                $todotask = $this->toDo->getAll();
                echo json_encode($todotask);
                break;
            case 'POST':
                $data = json_decode(file_get_contents('php://input'), true);
                $result = $this->toDo->create($data);
                echo json_encode($result);
                break;
            default:
                http_response_code(405);
                header("Allow: GET, POST");
        }
    }
}
?>
