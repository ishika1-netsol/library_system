<?php

require_once("classes/User.php");
$user = new User();
if (isset($_POST['update'])) {
    $UserID = $_GET['ID'];
    $name = $_POST['name'];
    $email = $_POST['email'];    
    $status = $_POST['status'];
    $user_type = $_POST['user_type'];
    $Updated_at = $_POST['updated_at'];
    $result = $user->updateUser($name, $email, $user_type, $status, date("Y-m-d H:i:s"), $UserID);
    if ($result) {
        header("location:UserTable.php");
    } else {
        echo ' Please Check Your Query ';
    }
} else {
    header("location:UserTable.php");
}


?>

