<!--
<?php
include_once 'server.php';
session_start(); //start a new session if not already started
?>

<!DOCTYPE html>
<html lang="en">
-->
<head>
    <title>Tech Hut</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }
        /* Style the header */

        .header img {
            width: 1000px;
            height: 200px;
            background: url("images/avatar.svg") no-repeat;
            background-size: cover;
            border: 6px solid #333;
            margin: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            color: #ddd;
            text-align: center;
        }
        /* Increase the font size of the h1 element */

        .header h1 {
            position: relative;
            top: 0px;
            left: 10px;
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

        * {
            margin: 0;
            padding: auto;
            font-family: sans-serif;
            outline: none;
        }

        body {
            background-color: black;
        }

        .container {
            border: 3px solid #303030;
            padding: 20px;
            width: 350 px;
            text-align: center;
            border-radius: 4px;
            position: relative;
			background: rgb(255,255,255);
        }

        .voting {
            /*position: relative;
            border: 3px solid#303030;
            border-radius: 4px;
            padding: 5px;
            display: flex;
            justify-content: center;*/
            margin: 100px auto;
            text-align: center;
        }

        .downvoting {
            margin: 100px auto;
            text-align: center;
        }

        .button {
            /*color: aquamarine;
            background: none;
            font-size: 20px;
            padding: 0 15px;
            margin: 10px 0;
            margin-left: 20px;
            cursor: pointer;*/
            padding: 20px;
            background: transparent;
            text-shadow: 1px 1px 1px #202020;
            font-family: "Lato", sans-serif;
            font-size: 18pt;
            border: 1px solid lightblue;
            color: lightblue;
        }

        button :active {
            color: cadetblue;
        }

        .col-sm-9 {
            border: thick solid rgb(15, 184, 23);
        }

        footer {
            text-align: center;
            padding: 3px;
            background-color: rgb(15, 184, 23);
            color: white;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="tech2.jpg" alt="logo" class="src">
        <h1><b>Welcome to Tech hut</b></h1>

    </div>

    <div class="navbar">
        <a href="index.php">Home</a>
        <?php
    		if (isset($_SESSION["userID"])){
    			echo("<a href=\"logout.php\" class=\"right\">Logout</a>");
    			echo("<a href=\"#\" class=\"right\">". $_SESSION["username"] ."</a>");
    		}
    		else{
          echo("<a href=\"registration.php\">Register</a>");
          echo("<a href=\"login.php\" class=\"right\">Login</a>");
        }
		    ?>
    </div>
    <div class="container">
        <h2><b> A fast and efficient website to ask your Tech questions </b></h2>
        <img src="" />
    </div>

    <!--<div class="voting">
        <button id="upvote">Upvote: 0</button>
        <script src="mybutton.js"></script>
    </div>-->
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-3 well">
                <div class="well">
                    <p><a href="#">My Profile</a></p>
                    <img src="bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">
                </div>
                <div class="well">
                    <p><a href="#">Tags</a></p>
                    <p>
                        <span class="label label-default">News Technology</span>
                        <span class="label label-primary">IT questions</span>
                        <span class="label label-success">HELP</span>
                        <span class="label label-info">Q&A</span>

                    </p>
                </div>

            </div>
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default text-left">
			      <div class="panel-body">
				  <label>Write Your Question Below</label>
				  </br>
				  <input type="hidden" name="submitQuestion" value="1" />
				  <textarea id="title" name="title" rows=1 cols="30" required placeholder="Question Title"></textarea>
				  </br></br>
				  <textarea id="userquestion" name="userquestion" rows=4 cols="50" required placeholder="Describe your question here"></textarea>
			      </div>
			      <div class="modal-footer">
				<input type="submit" class="btndefault" />
			      </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="well">
                            <p>John Doe</p>
                            <img src="download.png" class="img-circle" height="55" width="55" alt="Avatar">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="well">
                            <p>Hey i have a question???</p>
                            <div class="voting">
                                <button id="upvote">Upvote: 0</button>
                                <script src="mybutton.js"></script>
                            </div>
                            <div class="panel-body">
                              <label>Answer Question Below!</label>
                              <textarea id="userquestion" name="userquestion" rows=4 cols="50" placeholder="Please respond to question here"></textarea>
                            </div>
                            <div class="modal-footer">
                              <input type="submit" class="btndefault"/>
							  
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="well">
                            <p>john smith</p>
                            <img src="johnsmith.jpg" class="img-circle" height="55" width="55" alt="Avatar">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="well">
                            <p>hello guys! can ii ask a question???</p>
                            <div class="voting">
                                <button id="upvote">Upvote: 0</button>
                                <script src="mybutton.js"></script>
                            </div>
							<div class="panel-body">
                              <label>Answer Question Below!</label>
                              <textarea id="userquestion" name="userquestion" rows=4 cols="50" placeholder="Please respond to question here"></textarea>
                            </div>
                            <div class="modal-footer">
                              <input type="submit" class="btndefault" />
                            </div>
                        </div>

                    </div>
                </div>


            </div>

        </div>
    </div>
    <footer class="footer">
        <h5></h5>
    </footer>
    <footer class="footer">
        <p>Project by Team 01 for SOEN 341  <a>https://github.com/jasonhillinger/soen341project</a></p>
    </footer>
</body>

</html>
