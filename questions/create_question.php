<?php
require '../connection.php';

$quiz_id = "15";
$question_text = "What is javascript used for?";
$question_type = "multiple_choice";

$sql = "INSERT INTO Questions (QuizID, QuestionText, QuestionType) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $stmt->bind_param("sss", $quiz_id, $question_text, $question_type);
    if ($stmt->execute()) {
        echo "New question created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}


mysqli_close($conn);
?>