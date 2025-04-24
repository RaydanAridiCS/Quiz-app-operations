<?php
require "../connection.php";

$question_id = 3;

$question_text = "What is CSS used for?";
$question_type = "TF";

$sql = "UPDATE Questions SET QuestionText = ?, QuestionType = ? WHERE QuestionID = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $stmt->bind_param("ssi", $question_text, $question_type, $question_id);

    if ($stmt->execute()) {
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        if ($affected_rows > 0) {
            echo "Question updated successfully.";
        } elseif ($affected_rows == 0) {
            echo "Question not found or no changes were made.";
        } else {
            echo "Error updating question: " . mysqli_stmt_error($stmt);
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
