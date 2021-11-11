<?php
 include_once 'server.php';
$errors = array();
$response = [];
$response['status'] = "failed";
//needs question ID or answerID

$vote = $_POST['vote'];
$item = $_POST['item']; //item can be question or answer

// vote can be "up" or "down"
//updates the old voteCount stored in database with voteCount +/- 1 depending on vote
//user must be signed in to vote
//user can only vote a maximum of +1 or -1 for each question or answer

if ($item == "question"){
  $questionID = $_POST['questionID'];
  $fetchVoteQuery = "SELECT * FROM `votes` WHERE votes.voterID = $_SESSION['userID'] AND votes.questionID = $questionID;";
  $voteRes = mysqli_query($db, $fetchVoteQuery);
  $previousVote = mysqli_fetch_assoc($voteRes);
  mysqli_free_result($voteRes);
  if (is_null($previousVote)){
    if ($vote=="up"){
        $voteQuery = "INSERT INTO votes (voterID, questionID, upVote) VALUES ($_SESSION['userID'] , $questionID, 1);";
        mysqli_query($db, $voteQuery);
        $updateQuery = "UPDATE questions SET voteCount = (voteCount + 1) WHERE questionID = $questionID";
        mysqli_query($db, $updateQuery);
    }
    else if ($vote=="down"){
        $voteQuery = "INSERT INTO votes (voterID, questionID, upVote) VALUES ($_SESSION['userID'] , $questionID, 0);";
        mysqli_query($db, $voteQuery);
        $updateQuery = "UPDATE questions SET voteCount = (voteCount - 1) WHERE questionID = $questionID";
        mysqli_query($db, $updateQuery);
      }
    $response['status'] = "failed";
  }
  else{
    $hasVoted=$previousVote['hasVoted'];
    $upVote=$previousVote['upVote'];
    if ($vote=="up"){
        if(($hasVoted == 1 && $upVote == 0) || $hasVoted==0 ){
          $updateQuery = "UPDATE questions SET voteCount = (voteCount + 1) WHERE questionID = $questionID";
          mysqli_query($db, $voteQuery);
          if ($hasVoted == 1){
            $voteQuery = "UPDATE votes SET hasVoted = 0 WHERE voterID = $_SESSION['userID'] AND votes.questionID = $questionID);";
            mysqli_query($db, $voteQuery);
          }
          else{
            $voteQuery = "UPDATE votes SET upVote = 1 AND hasVoted = 1 WHERE voterID = $_SESSION['userID'] AND votes.questionID = $questionID);";
            mysqli_query($db, $voteQuery);
          }
          $response['status'] = "success";
        }
    }
    else if ($vote=="down"){
      if(($hasVoted == 1 && $upVote == 1) || $hasVoted==0 ){
        $updateQuery = "UPDATE questions SET voteCount = (voteCount - 1) WHERE questionID = $questionID";
        mysqli_query($db, $updateQuery);
        echo("Success");
        if ($hasVoted == 1){
          $voteQuery = "UPDATE votes SET upVote = 0 AND hasVoted = 0 WHERE voterID = $_SESSION['userID'] AND votes.questionID = $questionID);";
          mysqli_query($db, $voteQuery);
        }
        else{
          $voteQuery = "UPDATE votes SET upVote = 0 AND hasVoted = 1 WHERE voterID = $_SESSION['userID'] AND votes.questionID = $questionID);";
          mysqli_query($db, $voteQuery);
        }
        $response['status'] = "success";
      }
    }
  }
}

else{
  $answerID = $_POST['answerID'];
  $fetchVoteQuery = "SELECT * FROM `votes` WHERE votes.voterID = $_SESSION['userID'] AND votes.answerID = $answerID;";
  $voteRes = mysqli_query($db, $fetchVoteQuery);
  $previousVote = mysqli_fetch_assoc($voteRes);
  mysqli_free_result($voteRes);
  if (is_null($previousVote)){
    if ($vote=="up"){
        $voteQuery = "INSERT INTO votes (voterID, answerID, upVote) VALUES ($_SESSION['userID'] , $answerID, 1);";
        mysqli_query($db, $voteQuery);
        $updateQuery = "UPDATE answers SET voteCount = (voteCount + 1) WHERE answerID = $answerID";
        mysqli_query($db, $updateQuery);
    }
    else if ($vote=="down"){
        $voteQuery = "INSERT INTO votes (voterID, answerID, upVote) VALUES ($_SESSION['userID'] , $answerID, 0);";
        mysqli_query($db, $voteQuery);
        $updateQuery = "UPDATE answers SET voteCount = (voteCount - 1) WHERE answerID = $answerID";
        mysqli_query($db, $updateQuery);
      }
      $response['status'] = "success";
  }
  else{
    $hasVoted=$previousVote['hasVoted'];
    $upVote=$previousVote['upVote'];
    if ($vote=="up"){
        if(($hasVoted == 1 && $upVote == 0) || $hasVoted==0 ){
          $updateQuery = "UPDATE answers SET voteCount = (voteCount + 1) WHERE answerID = $answerID";
          mysqli_query($db, $voteQuery);
          if ($hasVoted == 1){
            $voteQuery = "UPDATE votes SET hasVoted = 0 WHERE voterID = $_SESSION['userID'] AND votes.answerID = $answerID);";
            mysqli_query($db, $voteQuery);
          }
          else{
            $voteQuery = "UPDATE votes SET upVote = 1 AND hasVoted = 1 WHERE voterID = $_SESSION['userID'] AND votes.answerID = $answerID);";
            mysqli_query($db, $voteQuery);
          }
          $response['status'] = "success";
        }
    }
    else if ($vote=="down"){
      if(($hasVoted == 1 && $upVote == 1) || $hasVoted==0 ){
        $updateQuery = "UPDATE answers SET voteCount = (voteCount - 1) WHERE answerID = $answerID";
        mysqli_query($db, $updateQuery);
        echo("Success");
        if ($hasVoted == 1){
          $voteQuery = "UPDATE votes SET upVote = 0 AND hasVoted = 0 WHERE voterID = $_SESSION['userID'] AND votes.answerID = $answerID);";
          mysqli_query($db, $voteQuery);
        }
        else{
          $voteQuery = "UPDATE votes SET upVote = 0 AND hasVoted = 1 WHERE voterID = $_SESSION['userID'] AND votes.answerID = $answerID);";
          mysqli_query($db, $voteQuery);
        }
        $response['status'] = "success";
      }
    }
  }
}

header('Content-type: application/json');
echo (json_encode($response));



// if(isset($_SESSION['userID'])){
//   $userID = $_SESSION['userID'];
//
//   if ($vote === "up"){
//     $voteQuery = "UPDATE questions SET voteCount = (voteCount + 1) WHERE questionID = $questionID";
//   }
//   else{
//     $voteQuery = "UPDATE questions SET voteCount = (voteCount - 1) WHERE questionID = $questionID";
//   }
//   mysqli_query($db,$voteQuery);
// }
?>
