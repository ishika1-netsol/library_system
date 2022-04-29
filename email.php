<?php
require_once('classes/User.php');
$user = new User();

if ($_GET['data'] == 'email') {
    $value = $_GET['email'];
}
    $query = $user->login($value);
    if ($query->num_rows > 0) {
        echo 'false';
    } else {
        echo 'true';
    }   
?>