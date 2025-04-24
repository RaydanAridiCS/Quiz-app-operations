<?php
require '../connection.php';

$question_id = 4;

$sql = "DELETE FROM Questions WHERE QuestionID = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    $stmt->bind_param("s", $question_id);
    if ($stmt->execute()) {
        echo "Question deleted successfully.";
    } else {
        echo "Error executing statement: " . $stmt->error;

        $stmt->close();
    }
} else {
    echo "Error preparing statement: " . $conn->error;
}



?>