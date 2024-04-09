<?php
$SERVER="localhost";
$pass="";
$username="root";
$db="task";

$con=mysqli_connect($SERVER,$username,$pass,$db);
if(!$con)
{
    die("connection not possible".mysqli_connect_error());
}
?>