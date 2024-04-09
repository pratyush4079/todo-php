<?php
require_once "todo.php";
class toDoImpl implements todo{
    private $con;
    public function __construct($con)
    {
        $this->con=$con;

    }
    public function create($data)
    {
        $name=$_POST['name'];
        $description=$_POST['description'];
        $sql="INSERT INTO `task`.todo`( `name`, `description`, `date`) VALUES ('$name','$description',current_timestamp())";
        if($this->con->query($sql))
        {
            
        }
        else{
            echo("operation failed");
        }
    }
    public function getAll(){
        $sql="Select * FROM `task`.`todo`";
        $result=mysqli_query($this->con,$sql);
        $todos=[];
        while ($row = mysqli_fetch_assoc($result)) {
            $todos[] = $row;
        }
        return $todos;


    }
    public function getById($id){
        $sql="Select * FROM `task`.`todo` WHERE id=$id";
        $result=mysqli_query($this->con,$sql);
        $todo=mysqli_fetch_assoc($result);
        return $todo;

    }
    public function delete($id)
    {
        $sql="DELETE FROM `task`.`todo` WHERE id=$id";
        if($this->con->query($sql))
        {
        }
        else{
            echo("operation failed");
        }
    }
    public function update($id,$data){
        $name=$_POST['name'];
        $description=$_POST['description'];
        $sql="UPDATE `task`.`todo` SET `name`='$name',`description`='$description',`date`=current_timestamp() WHERE id=$id";
        if($this->con->query($sql))
        {
        }
        else{
            echo("operation failed");
        }
    }
}