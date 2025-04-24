<?php
require '../connection.php';

$title = "Javascript Quiz";
$description = "This is a quiz about Javascript";
$isPublished = false;
$createdBy = "admin";

$sql = "SELECT UserID FROM Users WHERE username = '$createdBy';";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$userID = $row['UserID'];


$sql = "INSERT INTO Quizzes (Title, Description ,CreatedBy, IsPublished) VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssss", $title, $description, $userID, $isPublished);
    if (mysqli_stmt_execute($stmt)) {
        echo "New quiz created successfully";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

mysqli_close($conn)

    ?>