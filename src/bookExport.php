<?php
include("classes/Book.php");
$book = new Book();
  session_start();
  if(isset($_POST["export"])) {
    header("content-type: text/csv; charset=utf-8");
    header("content-disposition: attachment; filename=data.csv");
    $output = fopen("php://output", "w");
    fputcsv($output, array("id", "book_name", "author_name", "image", "status","created_at","updated_at","quantity"));
  if(isset($_SESSION['value'])){
    $filterValue = $_SESSION['value'];
  }
  $search = $book->searchBook($filterValue);
    while($row=mysqli_fetch_assoc($search)) {
      fputcsv($output, $row);
    }
    fclose($output);
  }
?>