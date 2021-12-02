<?php
  include_once "server.php";
  session_start(); //start a new session if not already started
  $editable = false;
  if (isset($_GET['userID'])){
    if ($_GET['userID'] != "") {
      if (isset($_SESSION["username"])) {
        if ($_SESSION["userID"] === $_GET['userID']) {//Check if the current signed-in user is the same as the user of the profile page
          $editable = true; //if the current signed-in user is the same as the user of the profile page, profile will be editable
        }
      }
      $profileID = $_GET['userID'];
    }
    else{//Else no userID in URL for profile page, redirect to homepage
      header('location: index.php');
    }
  }

  else{//Else no userID in URL for profile page, redirect to homepage
    header('location: index.php');
  }



  include 'fetchProfile.php';
  include 'updateProfile.php';
  $profile = getProfilebyID($profileID);

  $memberSince = strtotime($profile["time_created"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href=".css/profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src=".js/profile.js"></script>
</head>
<body>
    <body style="background-color:black;">
    <div class="header">
        <img src="tech2.jpg" alt="logo" class="src">
    </div>
    <div class="navbar">
        <a href="index.php">Home</a>
      <?php
        if (isset($_SESSION["userID"])){
          echo("<a href=\"logout.php\" class=\"right\">Logout</a>");
          echo("<a href=\"profile.php?userID=". $_SESSION["userID"] ."\" class=\"right\">". $_SESSION["username"] ."</a>");
        }
        else{
          echo("<a href=\"registration.php\" class=\"right\" >Register</a>");
          echo("<a href=\"login.php\" class=\"right\">Login</a>");
        }?>
    </div>
    <h1 style="text-align:center" >User Profile </h1>

    <form action="#" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">

    <div class="panel-heading">
        <img class="card-img-top" id="profilePic" src="data:image/jpeg;base64, <?php echo fetchProfilePic($profile["username"]); ?>" alt="Profile Picture" style="width:75%; max-width: 300px; max-height: 300px;">
        <div id="editImage" hidden>
            <div class="row justify-content-center" style="margin-top: 5px">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <p style="text-align: left; margin-bottom: 5px">Upload a profile picture</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input id="newPic" name="newPic" type="file" accept="image/png, image/jpeg" />
                </div>
            </div>
        </div>
        <div id="username">
            <h2><?php echo $profile["username"]; ?></h2>
        </div>
        <div style="display: none" id="usernameText" class="row justify-content-center">
            <div class="col-sm-4">
                <h3>Username:</h3>
            </div>
            <div class="col-sm-8">

                <textarea style="font-size: 18px; margin-top: 10px" id="newUsername" name="newUsername" class="form-control" rows="1"
                ><?php echo $profile["username"]; ?></textarea>
            </div>
        </div>

    </div>
    <div class="panel-body">
        <h4>About me:</h4>
        <p id="aboutMe"> <?php echo $profile["about"]; ?> </p>
        <textarea style="display: none; width: 80%" class="form-control" id="aboutText" name="aboutText" rows="3"><?php echo $profile["about"]; ?></textarea>
        <div class="modal-footer"></div>
        <h4>Email:</h4>
        <p> <?php echo $profile["email"]; ?> </p>
        <div class="modal-footer"></div>
        <h4>User ID:</h4>
        <p> <?php echo $profile["userID"]; ?> </p>
        <div class="modal-footer"></div>
        <h4 class="title">Registered Tech Hut User <span style="color: rgb(15, 184, 23)">&#10003;</span></h4>
        <h4>Member Since:</h4>
        <p> <?php echo date('m/d/Y', $memberSince); ?> </p>
    </div>
    <div class="panel-footer" <?php if(!$editable) {echo "style=\"display:none;\"";} ?> >
        <div class="row justify-content-center">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <button type="button" class="btn btn-default" id="editButton" onclick="editProfile()">Edit Profile</button>
                <button style="display: none;" type="submit" class="btn btn-default" id="submitButton" >Submit Changes</button>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>

    </div>
    </form>



    <footer class="footer">
        <p style="font-size: 16px">Project by Team 01 for SOEN 341  <a>https://github.com/jasonhillinger/soen341project</a></p>
    </footer>
</body>
</html>
