<?php

$host = 'localhost'; 
$dbname = 'todo'; 
$username = 'root'; 
$password = ''; 


require_once 'taskInterface.php';
require_once 'TaskManager.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task_submit'])) {
    try {
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $task_description = $_POST['task'];
        $stmt = $pdo->prepare("INSERT INTO task (description) VALUES (?)");
        $stmt->execute([$task_description]);
    } catch (PDOException $e) {
        
        die("Database error: " . $e->getMessage());
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_task_submit'])) {
    try {
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $task_id = $_POST['update_task_id'];
        $updated_description = $_POST['update_task_description'];
        $stmt = $pdo->prepare("UPDATE task SET description = ? WHERE id = ?");
        $stmt->execute([$updated_description, $task_id]);
    } catch (PDOException $e) {
        
        die("Database error: " . $e->getMessage());
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_task_submit'])) {
    try {
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $task_id = $_POST['delete_task_id'];
        $stmt = $pdo->prepare("DELETE FROM task WHERE id = ?");
        $stmt->execute([$task_id]);
    } catch (PDOException $e) {
        
        die("Database error: " . $e->getMessage());
    }
}


$tasks = [];
try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt = $pdo->query("SELECT * FROM task");
    if ($stmt) {
        
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Todo List</h1>
        <form method="POST" action="">
            <input type="text" name="task" placeholder="Add new task..." required>
            <button type="submit" name="add_task_submit">Add</button>
        </form>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <?php echo htmlspecialchars($task['description']); ?>
                    <form method="POST" action="">
                        <input type="hidden" name="update_task_id" value="<?php echo $task['id']; ?>">
                        <input type="text" name="update_task_description" placeholder="Update task" required>
                        <button type="submit" name="update_task_submit">Update</button>
                    </form>
                    <form method="POST" action="">
                        <input type="hidden" name="delete_task_id" value="<?php echo $task['id']; ?>">
                        <button type="submit" name="delete_task_submit">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
