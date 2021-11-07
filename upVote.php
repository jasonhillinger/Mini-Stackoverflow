<?php
 include_once 'server.php';
$errors = array();

//needs question ID, count
$count = mysqli_real_escape_string($db, $_POST['count']);
$questionID = mysqli_real_escape_string($db, $_POST['questionID']);

//might need error checking

// assuming count can be +1 or -1
//updates the old voteCount with a +/- 1
$query1 = "SELECT voteCount FROM questions WHERE questionID = $questionID";
$currentVoteCount = mysqli_query($db,$query1);
$count = $currentVoteCount + $count;
//

//updates the voteCount of the question being voted on to the count from JS
//might need to use an incremental approach depending on JS implementation
$query = "UPDATE questions SET voteCount = $count WHERE questionID = $questionID"; //This is where the SQL querie will go (Insert statement), to add the person if no errors
mysqli_query($db,$query);