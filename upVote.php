<?php
  include_once 'server.php';
  session_start();
  $errors = array();
  //if($_SERVER["REQUEST_METHOD"] == "POST"){
  //needs question ID, count
  $vote = $_POST['vote'];
  $questionID = $_POST['questionID'];

  //might need error checking

  // vote can be "up" or "down"
  //updates the old voteCount stored in database with voteCount +/- 1 depending on vote
  //user must be signed in to vote
  if(isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];

    if ($vote === "up"){
      $voteQuery = "UPDATE questions SET voteCount = (voteCount + 1) WHERE questionID = $questionID";
    }
    else{
      $voteQuery = "UPDATE questions SET voteCount = (voteCount - 1) WHERE questionID = $questionID";
    }
    mysqli_query($db,$voteQuery);
  }
?>
