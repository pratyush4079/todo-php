 <?php
require_once "toDoImpl.php";
require_once "config.php";

$toDo = new toDoImpl($con);
$path = $_SERVER["PATH_INFO"];
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');
switch ($method) {
    case 'GET':
        if ($path === '/todo') {
            $todo = $toDo->getAll();
            echo json_encode($todo);
        } elseif (preg_match('/\/todo\/(\d+)$/', $path, $matches)) {
            $todoId = $matches[1];
            $todo = $toDo->getById($todoId);
            echo json_encode($todo);
        }
        break;
    case 'POST':
        if ($path === '/todo') {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $toDo->create($data);
            echo json_encode($result);
        }
        break;
    case 'PUT':
        if (preg_match('/\/todo\/(\d+)$/', $path, $matches)) {
            $todoId = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $toDo->update($todoId, $data);
            echo json_encode($result);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/todo\/(\d+)$/', $path, $matches)) {
            $todoId = $matches[1];
            $result = $toDo->delete($todoId);
            echo json_encode(['success' => $result]);
        }
        break;
}
?>
