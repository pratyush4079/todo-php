<?php
require_once "Todo.php";
class ToDoImpl implements todo{
    private PDO $conn;
    public function __construct(Database $database)
    {
        $this->conn= $database->getConnection();

    }
    public function create($data)
    {
        $sql = "INSERT INTO `task`.`todo` (`name`, `description`, `date`) VALUES (:name, :description, current_timestamp())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo $data["name"] . "\n";
            echo $data["description"]."\n";
            return true;
        } else {
            echo "Operation failed";
            return false;
        }
    }

    public function getAll():array{
        $sql= "SELECT * FROM todo";
        $stmt = $this->conn->query($sql);
        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
    public function getById($id){
        $sql = "SELECT * FROM `task`.`todo` WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function delete($id)
{

        $sql = "DELETE FROM `task`.`todo` WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
}
public function update($id, $data)
{

        $sql = "UPDATE `task`.`todo` SET `name` = :name, `description` = :description WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindValue(":description", $data["description"], PDO::PARAM_STR);
        $stmt->execute();
        return true; 
}

}
