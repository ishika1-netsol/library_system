<?php
require_once("classes/Book.php");
$book = new Book();
if (isset($_POST['deleteUserbtn'])) {
    $BookID = $_POST['delete_id'];
    $result = $book->deleteBook($BookID);   
    if ($result) {
        header("location:BookDelete.php");
        exit;
    } else {
        echo ' Please Check Your Query ';
    }
} else {
    header("location:BookDelete.php");
    exit;
}
?>