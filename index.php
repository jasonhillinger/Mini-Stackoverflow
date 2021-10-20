<?php
include_once 'server.php';
session_start(); //start a new session if not already started
include_once 'posts.php';
?>

<!DOCTYPE html>
<html lang="en">
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
        .container {
          max-width: 1000px;
          margin: 30px auto;
          background: #fff;
          border-radius: 8px;
          padding: 20px;
        }
        .containerForComments {
          min-width: 450px;
          max-width: 450px;
          height: 300px;
          margin: 30px auto;
          background: #fff;
          border-radius: 10px;
          padding: 20px;
          border : thick solid rgb(15,184,23);
        }
        .comment {
          display: block;
          transition: all 1s;
        }
        .commentClicked {
          min-height: 0px;
          border: 1px solid #eee;
          border-radius: 5px;
          padding: 5px 10px
        }
        .container textarea {
          width: 100%;
          border: none;
          background: #E8E8E8;
          padding: 5px 10px;
          height: 50%;
          border-radius: 5px 5px 0px 0px;
          border-bottom: 2px solid rgb(15, 184, 23);
          transition: all 0.5s;
          margin-top: 15px;
        }
        button.primaryContained {
          background:  rgb(15, 184, 23);
          color: #fff;
          padding: 10px 10px;
          border: none;
          margin-top: 0px;
          cursor: pointer;
          text-transform: uppercase;
          letter-spacing: 4px;
          box-shadow: 0px 2px 6px 0px rgba(0, 0, 0, 0.25);
          transition: 1s all;
          font-size: 10px;
          border-radius: 5px;
        }
        button.primaryContained:hover {
          background: #9f2efc;
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
            margin: 15px auto;
            text-align: center;
        }

        .downvoting {
            margin: 5px auto;
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
            height = 100px;
            border: thick solid rgb(15, 184, 23);
        }

        footer {
            text-align: center;
            padding: 3px;
            background-color: rgb(15, 184, 23);
            color: white;
        }
        #left {
            text-align: left;
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
            echo("<a href=\"registration.php\" class=\"right\" >Register</a>");
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
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default text-left">
                          <form id="form" action="#" method="post">
                            <div class="panel-body">
                                <label>Have a Question?</label>
                                <br>
                                <input type="hidden" name="submitQuestion" value="1" />
                                <textarea class="form-control" id="title" name="title" rows=1 cols="30" required placeholder="Question Title"></textarea>
                                <textarea class="form-control" id="userQuestion" name="userQuestion" rows=4 cols="50" required placeholder="Describe your question here"></textarea>
                            </div>
                            <div class="modal-footer">
                              <input type="submit" class="btn btn-default" value="Submit Question">
                            </div>
                          </form>
                        </div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <?php
                    if (isset($_SESSION["userID"])){
                        echo("            
                    <div class=\"col-sm-3 well\">
                    <div class=\"well\">
                        <p><a href=\"#\">". $_SESSION["username"] ."</a></p>
                    <img src=\"download.png\" class=\"img-circle\" height=\"65\" width=\"65\" alt=\"Avatar\">
                    </div>
                    <div class=\"well\">
                        <p><a href=\"#\">Tags</a></p>
                        <p>
                            <span class=\"label label-default\">News Technology</span>
                            <span class=\"label label-primary\">IT questions</span>
                            <span class=\"label label-success\">HELP</span>
                            <span class=\"label label-info\">Q&A</span>
    
                        </p>
                    </div>
                    </div>");
                    }
                    else{
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-2">
                        <div class="well">
                            <p><?php /*@//TODO: php code goes here (echo asker)*/ echo("John Smith")?></p>
                            <img src="download.png" class="img-circle" height="55" width="55" alt="Avatar">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="well">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 id="left"> This is where question title will go</h4>
                                    <p id="left">This is where question content will go</p>
                                    <div class="voting">
                                        <button id="upvote">Upvote: 0</button>
                                        <script src="mybutton.js"></script>
                                    </div>
                                </div>
                                <div class = "panel-body">
                                    <p id="left">This is where answer 1 content will go</p>
                                    <div class="modal-footer">
                                    </div>
                                    <p id="left">This is where answer 2 content will go</p>
                                    <div class="modal-footer">
                                    </div>
                                    <p id="left">This is where answer 3 content will go</p>
                                    <div class="modal-footer">
                                    </div>
                                    <p id="left">This is where answer 4 content will go</p>
                                </div>
                                <div class="panel-footer">
                                    <div class="form-floating">
                                        <form id="form" action="#" method="post">
                                            <input type="hidden" name="submitAnswer" value="1" />
                                            <input type="hidden" name="refQuestion" value="<?php /*@//TODO: php code goes here (echo questionID)*/ echo(10)?>" />
                                            <textarea class="form-control" id="userAnswer" name="userAnswer" rows=2 cols="50" required placeholder="Answer question here"></textarea>
                                            <input type="submit" class="btn btn-default" value="Submit Answer">
                                        </form>
                                    </div>
                                </div>
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
