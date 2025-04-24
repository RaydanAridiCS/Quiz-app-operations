<?php
require 'connection.php';

$username = "newUser"; 
$email = "test@gmail.com";
$password = "password123";    

$sql = "SELECT  username, passwordhash FROM Users WHERE username = ? OR email = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['passwordhash'])) {
            echo "Login successful!, Username: " . $row['username'];
            exit();
        }
        echo "Invalid password!";
    } else {
        echo "User not found!";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

mysqli_close($conn);
?>