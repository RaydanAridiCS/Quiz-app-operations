<?php
require 'connection.php';

$quiz_id = 14; 
$title = "CSS quiz";
$description = "This is a quiz about CSS";
$isPublished = true;

$sql = "UPDATE Quizzes SET Title = ?, Description = ?, IsPublished = ? WHERE QuizID = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $stmt->bind_param("ssii", $title, $description, $isPublished, $quiz_id); 

    if (mysqli_stmt_execute($stmt)) {
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        if ($affected_rows > 0) {
            echo "Quiz updated successfully.";
        } elseif ($affected_rows == 0) {
            echo "Quiz not found or no changes were made.";
        }
         else {
            echo "Error updating quiz: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error executing statement: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
