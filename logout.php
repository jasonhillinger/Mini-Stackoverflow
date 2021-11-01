<?php
	include_once 'server.php';
	session_start();
	session_destroy();
	header("Location: index.php");
	exit();
?>
