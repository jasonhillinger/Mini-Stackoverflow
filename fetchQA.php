<?php
include_once 'server.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$rowsQuery = "SELECT * FROM questions"; //Query to fetch all questions from DB
// Execute the query and store the result
$result = mysqli_query($db, $rowsQuery);

if($result === false) {
    die("Database query failed");
} else {
    // it return number of rows in the table.
    $row = mysqli_num_rows($result);
    //echo($row);
    for($i = 0; $i < $row; $i++){
        $row_i_Query= "SELECT * FROM questions ORDER BY questionID DESC LIMIT 1 OFFSET $i";
        $rowResult = mysqli_query($db, $row_i_Query);
        $currentQuestion = mysqli_fetch_assoc($rowResult);
        mysqli_free_result($rowResult);
        $_SESSION["currentQuestion"] = $currentQuestion;
        //echo($currentQuestion['questionID'] . "<br>" . $currentQuestion['title'] . "<br>" . $currentQuestion['questionText'] . "<br>" . $currentQuestion['asker'] . "<br>" );
        include 'printQandA.phtml';
        $_SESSION["currentQuestion"] = NULL;
    }
    $_SESSION["currentQuestion"] = NULL;
    // close the result.
    mysqli_free_result($result);
}


?>
