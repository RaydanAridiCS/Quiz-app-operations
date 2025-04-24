<?php
require '../connection.php';

$question_id = 5; 

$sql = "SELECT OptionID, OptionText, IsCorrect FROM Options WHERE QuestionID = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $stmt->bind_param("i", $question_id);

    if ($stmt->execute()) {
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $decodedOptions = json_decode($row['OptionText'], true);
            $options[] = array(
                'QuestionID' => $question_id,
                'OptionID' => $row['OptionID'],
                'OptionText' => $decodedOptions,
                'IsCorrect' => $row['IsCorrect']
            );
        }

        header('Content-Type: application/json');
        echo json_encode($options);

    } else {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Error executing query: ' . mysqli_stmt_error($stmt)));
        die(); 
    }
    mysqli_stmt_close($stmt);
} else {

    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Error preparing statement: ' . mysqli_error($conn)));
    die(); 
}

mysqli_close($conn);
?>
