<?php 

require_once('classes/User.php');
$user = new User();

if(isset($_POST['create']))
  {
    $name=$_POST['firstname'];
    $email=$_POST['email'];
     $password=$_POST['password'];
    $cpassword = $_POST['cpassword'];
     $user_type=$_POST['user_type'];
    $status=$_POST['status'];
   if($password === $cpassword)
   {
     $hash = password_hash($password,PASSWORD_DEFAULT);
    $query = $user->insertUser($name, $email, $hash, $user_type, $status);
   }
  
     if ($query) {
    echo 'You have successfully inserted the data';
  }
  else
    {
      echo 'Something Went Wrong. Please try again';
    }
}
  header("Location: http://localhost/library%20system/user_list.php");

?>