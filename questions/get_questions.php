<?php
require '../connection.php';

$quiz_id = "15";

$sql = "SELECT QuestionID, QuestionText, QuestionType FROM Questions WHERE QuizID = ?"; // Select only the columns you need
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $stmt->bind_param("s", $quiz_id);
    if ($stmt->execute()) {
        $result = mysqli_stmt_get_result($stmt);

        while ($row = $result->fetch_assoc()) {
            $questions[] = array(
                "QuestionID" => $row["QuestionID"],
                "QuestionText" => $row["QuestionText"],
                "QuestionType" => $row["QuestionType"]
            );
        }
        $stmt->close();

        header('Content-Type: application/json'); // Set the correct header
        echo json_encode($questions);

    } else {
        header('Content-Type: application/json');
        echo json_encode(array("error" => "Error executing statement: " . $stmt->error));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Error preparing statement: " . mysqli_error($conn)));
}

mysqli_close($conn);
?>
