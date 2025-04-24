<?php
require '../connection.php';

$quiz_id = "15";

$sql = "SELECT * FROM Questions WHERE QuizID = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $stmt->bind_param("s", $quiz_id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $question_id = $row["QuestionID"];
            $question_text = $row["QuestionText"];
            $question_type = $row["QuestionType"];
            echo"Question ID: " . $question_id . "<br>";
            echo"Question Text: " . $question_text . "<br>";
            echo"Question Type: " . $question_type . "<br>";
            echo"<br>";
        }
        $stmt->close();
    } else {
        echo"Error executing statement: " . $stmt->error;
    }
} else {
    echo "Error preparing statement: " . $conn->error;
}


mysqli_close($conn);
?>