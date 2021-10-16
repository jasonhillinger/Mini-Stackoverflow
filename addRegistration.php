<?php
 include_once 'server.php';
$errors = array();

// Registering a new person to the database
$username = mysqli_real_escape_string($db, $_POST['username']);
$email = mysqli_real_escape_string($db, $_POST['Email']);
$password = mysqli_real_escape_string($db, $_POST['password']);

//check db for existing person unique values
$user_check_query = "SELECT * FROM users WHERE email = '$email' or username ='$username'"; // this will be an SQL querie (SELECT statement) to check if primary key already exist

$results = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($results);

if($user){

  if($user['email'] === $email){array_push($errors, "Account already exist with this email!");}
  if($user['username'] === $username){array_push($errors, "Account already exist with this username!");}

}
  if(count($errors) == 0){

    $query = "INSERT INTO users (username, password, email) VALUES ('$username','$password','$email')"; //This is where the SQL querie will go (Insert statement), to add the person if no errors
    mysqli_query($db,$query);
    
    // redirect to submitted page
    // may be changed depending on html implementation
    header("Location: Sumbit.php");

  }
  else{
      //Failed.php is a placeholder for an unsuccesful request
      //May be changed depending on html implementation
    header("Location: Failed.php");
}