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
    <link href="style.css" rel="stylesheet">
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
               <!-- <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-2">
                        <div class="well">
                            <p><?php /*@//TODO: php code goes here (echo asker)*/ //echo("John Smith")?></p>
                            <img src="download.png" class="img-circle" height="55" width="55" alt="Avatar">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="well">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 id="left"> This is where question title will go</h4>
                                    <p id="left">This is where question content will go<br></p>
                                    <p id="left"><?php //include 'fetchQA.php'; ?></p>
									<div class="vote roundrect">
									  <div class="increment up"></div>
									  <div class="increment down"></div>

									  <div class="count">0</div>
									</div>
									<script type="text/javascript">
									  $(function(){
										  $(".increment").click(function(){
											var count = parseInt($("~ .count", this).text());

											if($(this).hasClass("up")) {
											  var count = count + 1;

											   $("~ .count", this).text(count);
											}

											else {
											  var count = count - 1;
											   $("~ .count", this).text(count);
											}

											$(this).parent().addClass("bump");

											setTimeout(function(){
											  $(this).parent().removeClass("bump");
											}, 400);
										  });
										});
								  </script>
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
                    </div> -->

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
