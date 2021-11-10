<?php
  include_once 'server.php';
  session_start();
  $response = [];

  if (isset($_SESSION['userID'])){
    $response['status'] = "signedIn";
  }
  else{
    $response['status'] = "notSignedIn";
  }
  header('Content-type: application/json');
  echo (json_encode($response));

?>
