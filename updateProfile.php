<?php
  include_once 'server.php';
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userID = $_SESSION["userID"];
    //newPic, newUsername, aboutText
    if(isset($_POST['newUsername']) && isset($_POST['aboutText'])) { //if both newUsername and aboutText is set, retrieve both from POST
      $newUsername = mysqli_real_escape_string($db, $_POST['newUsername']);
      $newAbout = mysqli_real_escape_string($db, $_POST['aboutText']);
      $name=$_FILES['newPic']['name'];

      if($name!="") { //If new picture was uploaded, update profile_pic and about and username
        $size=$_FILES['newPic']['size'];
        if ($size <= 16777215){ //check if image uploaded is less than or equal to 16mb. Profile pic cannot exceed 16mb
          $image = $_FILES['newPic']['tmp_name']; //retrieve uploaded image file from POST FILES
          $newPic = file_get_contents($image); //store new profile pic in $newPic
          $updateAllString = "UPDATE users SET username = '$newUsername', about = '$newAbout', profile_pic = ? WHERE users.userID = $userID";
          $updateAllStmt= mysqli_prepare($db, $updateAllString);
          mysqli_stmt_bind_param($updateAllStmt, "s", $newPic );
          mysqli_stmt_execute($updateAllStmt);
          $check = mysqli_stmt_affected_rows($updateAllStmt);
          if($check==1){
            $msg = 'Image Successfully Uploaded';
          }
          else{
            $msg = 'Error uploading image';
          }
        }
      }
      else{//Else NO new picture was uploaded, update ONLY about and username
        $updateNoPic = "UPDATE users SET username = '$newUsername', about = '$newAbout' WHERE users.userID = $userID";
        mysqli_query($db,$updateNoPic);
      }
    }
  }
