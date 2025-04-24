<?php
require '../connection.php';

$question_id = 9;
$sql = "SELECT QuestionType FROM Questions WHERE QuestionID = ?";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $stmt->bind_param("i", $question_id);
    if ($stmt->execute()) {
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $question_type = $row['QuestionType'];

            $options = [];
            $correctOption = '';

            if ($question_type === "MCQ") {
                $options = ["For back-end", "For Front-end", "For both", "For none"];
                $correctOption = "For both";
            } else if ($question_type === "TF") {
                $options = ["True", "False"];
                $correctOption = "True";
            }

            $sql = "INSERT INTO Options (QuestionID, OptionText, IsCorrect) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {

                $optionsJson = json_encode($options);
                $isCorrectValue = $correctOption; 

                $stmt->bind_param("iss", $question_id, $optionsJson, $isCorrectValue); 

                if (!mysqli_stmt_execute($stmt)) {
                    die("Error executing option insert: " . mysqli_stmt_error($stmt));
                }

                echo "Options created successfully";
            } else {
                die("Error preparing options statement: " . mysqli_error($conn));
            }
        } else {
            echo "Question not found.";
        }
    } else {
        die("Error executing question query: " . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);
} else {
    die("Error preparing question query: " . mysqli_error($conn));
}

mysqli_close($conn);
?>
