<?php
$student_id = $_POST['id'];
include('classes/User.php');
$user = new User();
$query =$user->deleteUser($student_id);
if($query){
    echo 1;
}else{
    echo 0;
}

?>