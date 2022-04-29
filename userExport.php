<?php
include("classes/User.php");
$user = new User();
session_start();
if (isset($_POST["export"])) {
    header("content-type: text/csv; charset=utf-8");
    header("content-disposition: attachment; filename=data.csv");
    $output = fopen("php://output", "w");
    fputcsv($output, array("id", "name", "email", "password","user_type","status" ,"created_at", "updated_at"));    

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>