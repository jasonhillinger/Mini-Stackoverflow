<?php
include_once 'server.php';
session_start(); //start a new session if not already started
include_once 'posts.php';
include_once 'upVote.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tech Hut</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $(function(){
        $(".increment").click(function(){

        let questionID = $("~ .count", this).attr("id");
        let count = parseInt(document.getElementById(questionID).innerHTML);
        let vote = "";

        $.ajax({ //check if user is signed in
            type: "POST",
            data: "user",
            url: "signedIn.php",
            async: false,
            success: function (msg) {
              if(msg.status=="notSignedIn"){
                alert("You must be signed in to vote");
              }
              else if (msg.status=="signedIn"){
                signedIn = true;
                //alert("You are signed in");
              }
            }
        });

        if (!signedIn){
          return false;
        }

        if (($(this).hasClass("up"))) {
          count ++;
          document.getElementById(questionID).innerHTML=count.toString();
          vote="up";
        }

        else if (($(this).hasClass("down"))){
           count--;
           document.getElementById(questionID).innerHTML=count.toString();
           vote="down";
        }

        $.post({ //Send the current vote count and questionID to POST
            type: "POST",
            data: "questionID=" + questionID + "&vote=" + vote,
            url: "upVote.php"
        });



        $(this).parent().addClass("bump");

        setTimeout(function(){
          $(this).parent().removeClass("bump");
        }, 400);
        });
      });
    </script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        /* Green theme color in hex: #0fb817 */

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
          border-radius: 0px 0px 0px 0px;
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

		a {
			padding-left: 5px;
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

        @import url(https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic);

		.roundrect .up {
		  border-radius: 2rem 2rem 0 0;
		}
		.roundrect .down {
		  border-radius: 0 0 2rem 2rem;
		}
		.roundrect .count {
		  border-radius: 0.5rem 0.5rem;
		}


    .vote {
      display: flex;
      flex-direction: column;
      font-family: "Noto Sans";
      position: relative;
      width: 3rem;
      height: 3rem;
      margin: 0.5rem;
    }


		.increment {
		  flex: 1 0 0;
		  text-align: center;
		  opacity: 0.5;
		  transition: 0.3s;
		  cursor: pointer;
		}
		.increment.up {

		  background: #0fb817;

		  height: 50%;
		  margin-bottom: 0.25rem;
		}
		.increment.down {
		  background: #C15044;
		  height: 50%;
		}
		.increment:hover {
		  opacity: 1;
		}


    .count {
      position: absolute;
      top: 5;
      border-radius: 0.05rem;
      margin: 0.75rem;
      background: #F6F3E4;
      width: 1.5rem;
      font-size: 0.75rem;
      font-weight: bold;
      line-height: 1.5rem;
      text-align: center;
      box-shadow: 0 0 0 0.2rem #F6F3E4;
      pointer-events: none;
    }
		.count.upvoted {
		  color: #08660c;

		}
		.count.downvoted {
		  color: #C15044;
		}

		.bump {
		  -webkit-animation: bump 200ms;
				  animation: bump 200ms;
		}

		@-webkit-keyframes bump {
		  30% {
			transform: scale(1.2);
		  }
		}

		@keyframes bump {
		  30% {
			transform: scale(1.2);
		  }
		}
		* {
		  box-sizing: border-box;
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
            <!--border: thick solid rgb(15, 184, 23);-->
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

    <div class="container text-center">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default text-left">
                          <form id="form" method="post">
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
                <?php include 'fetchQA.php'; ?>

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
