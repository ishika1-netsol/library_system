<?php
include("classes/Issue.php");
$issue = new Issue();
session_start();
if (isset($_POST["export"])) {
    header("content-type: text/csv; charset=utf-8");
    header("content-disposition: attachment; filename=data.csv");
    $output = fopen("php://output", "w");
    fputcsv($output, array("book_name", "name", "issue_date", "return_date","status" ,"created_at", "updated_at"));  
    $result = $issue->Joins();
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
}
