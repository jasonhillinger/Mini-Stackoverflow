<?php
 include_once 'server.php';
$errors = array();

//answerID and best may change on JS implementation
$best = mysqli_real_escape_string($db, $_POST['best']);
$answerID = mysqli_real_escape_string($db, $_POST['answerID']);

//May not be needed if answerID is unique for all answers
$questionID = mysqli_real_escape_string($db, $_POST['questionID']);


//might need error checking
//maybe check if already isBest is true?

//May need "AND refQuestion = questionID" in where clause if the answers are not unique for all answers
$query = "UPDATE answers SET isBest = $count WHERE answerID = $answerID"; //This is where the SQL querie will go (Insert statement), to add the person if no errors
mysqli_query($db,$query);