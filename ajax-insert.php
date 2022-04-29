<?php
include_once('classes/User.php');
$user = new User(); 
$name = $_POST['firstname'];
$email = $_POST['Email'];
$password = $_POST['Pass'];
$cpassword = $_POST['confirm'];
$user_type = $_POST['user'];
$status = "1";
$hash = password_hash($password, PASSWORD_DEFAULT);
$query = $user->insertUser($name, $email, $hash, $user_type, $status);

  if ($query) {
    echo 1;
  }else
    {
      echo 0;
    }
?>