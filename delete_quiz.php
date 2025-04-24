<?php
require "connection.php";

$quiz_id = "16";

$sql = "DELETE FROM Quizzes WHERE QuizID = ?";
$stmt = mysqli_prepare($conn , $sql);

if ($stmt) {
    $stmt->bind_param("s", $quiz_id);
    if (mysqli_stmt_execute($stmt)) {
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        if ($affected_rows > 0) {
            echo "Quiz deleted successfully.";
        } elseif ($affected_rows == 0) {
            echo "Quiz not found.";
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
