<?php
require '../connection.php';


$new_username = "newUser"; 
$new_email = "test@gmail.com";
$new_password = "password123"; 
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

$sql = "INSERT INTO Users (username, email ,passwordhash) VALUES (?, ?,?)"; 

$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sss", $new_username,$new_email, $hashed_password); 
    
    if (mysqli_stmt_execute($stmt)) {
        echo "New user created successfully";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}


mysqli_close($conn);

?>