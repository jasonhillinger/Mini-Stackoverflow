<?php

  function fetchProfile($email){
    include "server.php";
    $profileQuery = "SELECT * FROM users where email = '$email'"; //Fetches user info from database.

    $resultProfile = mysqli_query($db, $profileQuery);
    $userProfile = mysqli_fetch_assoc($resultProfile); //retrieves all user data stored in the result from SQL query

    $_SESSION["userID"] = $userProfile["userID"];
    $_SESSION["username"] = $userProfile["username"];
    $_SESSION["email"] = $userProfile["email"];
    $_SESSION["time_created"] = $userProfile["time_created"];
    $_SESSION["about"] = $userProfile["about"];
    mysqli_free_result($resultProfile);
  }


