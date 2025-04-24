<?php

require '../connection.php';

$sql = "SELECT * FROM Quizzes";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $quizzes[] = array(
            'QuizID' => $row['QuizID'],
            'Title' => $row['Title'],
            'Description' => $row['Description'],
            'CreatedBy' => $row['CreatedBy'],
            'IsPublished' => $row['IsPublished']
        );
    }
    echo json_encode($quizzes);
} else {
    echo json_encode(array(
            'error'=> 'No quizzes found'
        ));
}

mysqli_close($conn);

?>