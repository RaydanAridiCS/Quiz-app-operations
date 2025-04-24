<?php
require '../connection.php';

$question_id = 2;

$mcqOptions = ["Updated Back-end", "Updated Front-end", "Updated both", "Updated none"];
$mcqCorrectOption = "Updated both";

$tfOptions = ["True", "False"];
$tfCorrectOption = "False";

$sql = "SELECT QuestionType FROM Questions WHERE QuestionID = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $stmt->bind_param("i", $question_id);
    if ($stmt->execute()) {
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $question_type = $row['QuestionType'];

            if ($question_type === "MCQ") {
                $newOptions = $mcqOptions;
                $correctOption = $mcqCorrectOption;
            } else if ($question_type === "TF") {
                $newOptions = $tfOptions;
                $correctOption = $tfCorrectOption;
            } else {
                die("Error: Question type is neither MCQ nor TF.");
            }

            $optionsJson = json_encode($newOptions);

            $sql = "UPDATE Options SET OptionText = ?, IsCorrect = ? WHERE QuestionID = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                $stmt->bind_param("ssi", $optionsJson, $correctOption, $question_id);

                if ($stmt->execute()) {
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        echo "Options updated successfully!";
                    } else {
                        echo "No changes made - existing options are already up to date.";
                    }
                } else {
                    die("Error updating options: " . mysqli_stmt_error($stmt));
                }
            } else {
                die("Error preparing update statement: " . mysqli_error($conn));
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