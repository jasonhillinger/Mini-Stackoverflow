<?php
include_once "server.php";
session_start(); //start a new session if not already started
if (!isset($_SESSION["username"])){
    header('location: index.php');
}
include 'fetchProfile.php';
fetchProfile($_SESSION['email']);
$memberSince = strtotime($_SESSION["time_created"]);
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
	<style>
	.card {
	  box-shadow: 0 4px 8px white;
	  background-color: blueviolet;
	  max-width: 400px;
	  margin: auto;
	  text-align: center;
	  font-family: arial;
        padding-bottom: 15px;
	}

    .header img {
        width: 1000px;
        height: 200px;
        background: no-repeat;
        background-size: cover;
        border: 6px solid #333;
        margin: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        color: #ddd;
        text-align: center;
    }

    /* Style the top navigation bar */

    .navbar {
        overflow: hidden;
        background-color: rgb(15, 184, 23);
    }


    /* Style the navigation bar links */

    .navbar a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
    }


    /* Right-aligned link */

    .navbar a.right {
        float: right;
    }


    /* Change color on hover */

    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }

	.title {
	  color: rgb(15, 184, 23);
	  font-size: 18px;
	}

	button {
	  border: none;
	  outline: 0;
	  display: inline-block;
	  padding: 8px;
	  color: white;
	  background-color: #000;
	  text-align: center;
	  cursor: pointer;
	  width: 100%;
	  font-size: 18px;
	}
	.footer {
	  background-color: rgb(15, 184, 23);
	  color: white;
	  text-align: center;
      margin-top: 50px;
	}
	a {
	  text-decoration: none;
	  /*font-size: 18px;*/
	  color: white;
	}
	footer {
		text-align: center;
		padding: 1px;
		background-color: rgb(15, 184, 23);
		color: white;
	}
	button:hover, a:hover {
	  opacity: 0.7;
	}
	.h1{
		color: black;
	}
	h1{
		color: rgb(15, 184, 23);
	}

	span {
	  content: "\2713";
	  color: lightskyblue;
	}
	</style>

</head>
<body>
    <body style="background-color:black;">
    <div class="header">
        <img src="tech2.jpg" alt="logo" class="src">
    </div>
    <div class="navbar">
        <a href="index.php">Home</a> <?php
        if (isset($_SESSION["userID"])){
          echo("
			<a href=\"logout.php\" class=\"right\">Logout</a>");
          echo("
			<a href=\"#\" class=\"right\">". $_SESSION["username"] ."</a>");
        }
        else{
          echo("
			<a href=\"registration.php\" class=\"right\" >Register</a>");
          echo("
			<a href=\"login.php\" class=\"right\">Login</a>");
        }
      ?>
    </div>
<h1 style="text-align:center" >User Profile </h1>

<div class="card">
    <img class="card-img-top" src="data:image/jpeg;base64, <?php echo fetchProfilePic($_SESSION["username"]); ?>" alt="Profile Picture" style="width:75%">
    <h2><?php echo $_SESSION["username"]; ?></h2>
    <p class="title">Registered Tech Hut User <span>&#10003;</span></p>

    <div class="modal-footer"></div>
    <h4>About me:</h4>
    <p> <?php echo $_SESSION["about"]; ?> </p>
    <div class="modal-footer"></div>
    <h4>Email:</h4>
    <p> <?php echo $_SESSION["email"]; ?> </p>
    <div class="modal-footer"></div>
    <h4>User ID:</h4>
    <p> <?php echo $_SESSION["userID"]; ?> </p>
    <div class="modal-footer"></div>
    <h4>Member Since:</h4>
    <p> <?php echo date('m/d/Y', $memberSince); ?> </p>


<!-- <div class="w3-card w3-round w3-white w3-hide-small">-->
<!--    <div class="w3-container">-->
<!--      <p>User InfoHere are some of my interests</p>-->
<!--      <p>-->
<!--        <span class="w3-tag w3-small w3-theme-d5">Tech</span>-->
<!--        <span class="w3-tag w3-small w3-theme-d4">Questions</span>-->
<!--        <span class="w3-tag w3-small w3-theme-d3">Labels</span>-->
<!--        <span class="w3-tag w3-small w3-theme-d2">Games</span>-->
<!--        <span class="w3-tag w3-small w3-theme-d1">Friends</span>-->
<!--        <span class="w3-tag w3-small w3-theme">Games</span>-->
<!---->
<!--      </p>-->
<!--    </div>-->
<!--  </div>-->
<!--  <p><button>Click to Dm me ≧◡≦</button></p>-->
</div>



<footer class="footer">
    <p>Project by Team 01 for SOEN 341  <a>https://github.com/jasonhillinger/soen341project</a></p>
</footer>
</body>

</html>
