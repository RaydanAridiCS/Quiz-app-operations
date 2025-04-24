<?php
// I have a hostinger plan and I am using it to host my database.
// I have created a database named QuizApp.


$host = "localhost"; 
$username = "root";
$password = "";
$database="QuizApp";


$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed". $conn->connect_error);
}
?>