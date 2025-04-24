<?php
require '../connection.php';

$question_id = 5; 
$option_id = 4;   


$sql = "DELETE FROM Options WHERE QuestionID = ? AND OptionID = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $stmt->bind_param("ii", $question_id, $option_id);

    if ($stmt->execute()) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Option deleted successfully!";
        } else {
            echo "No option found with the specified ID.";
        }
    } else {
        die("Error deleting option: " . mysqli_stmt_error($stmt));
    }
} else {
    die("Error preparing delete statement: " . mysqli_error($conn));
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>