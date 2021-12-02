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
  function getProfileByID($ID){
    include "server.php";
    $profileQuery = "SELECT * FROM users where userID = '$ID'"; //Fetches user info from database.

    $resultProfile = mysqli_query($db, $profileQuery);
    $userProfile = mysqli_fetch_assoc($resultProfile); //retrieves all user data stored in the result from SQL query
    mysqli_free_result($resultProfile);

    return $userProfile; //returns entire user profile (without image)
  }

  function fetchProfilePic($username) {
    include "server.php";
    $picQuery = "SELECT profile_pic FROM users where username = '$username'"; //Fetches user info from database.

    $resultPic = mysqli_query($db, $picQuery);
    $userProfilePic = mysqli_fetch_assoc($resultPic); //retrieves all user data stored in the result from SQL query
    $picture = base64_encode($userProfilePic["profile_pic"]);
    mysqli_free_result($resultPic);
    return $picture;
  }

