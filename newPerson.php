<?php
 include_once 'server.php';
$errors = array();

// Registering a new person to the database
//html variables are currently place holders as of 10/09/2021

//$person_id = mysqli_real_escape_string($db, $_POST['person_id']); //maybe add this??
$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
$dob = mysqli_real_escape_string($db, $_POST['dob']);
$telephone = mysqli_real_escape_string($db, $_POST['telephone']);
$city = mysqli_real_escape_string($db, $_POST['city']);
$address = mysqli_real_escape_string($db, $_POST['address']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$password = mysqli_real_escape_string($db, $_POST['password']);

//check db for existing person unique values
$user_check_query; // this will be an SQL querie (SELECT statement) to check if primary key already exist

$results = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($results);

if($user){

  //PRIVATEKEY is a placeholder variable for a private key  
  if($user['PRIVATEKEY'] === $person_id){array_push($errors, "PRIVATEKEY already exist");}

}
  if(count($errors) == 0){

    $query; //This is where the SQL querie will go (Insert statement), to add the person if no errors
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