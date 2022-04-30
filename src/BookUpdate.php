<?php

require_once("classes/Book.php");
$book = new Book();
if (isset($_POST['update'])) {
    $bookID = $_GET['ID'];
    $bookName = $_POST['name'];
    $bookAuthor = $_POST['author_name'];
    $bookQuantity = $_POST['quantity'];
    $bookStatus = $_POST['status'];
    $result = $book->updateBook($bookName, $bookAuthor, $bookStatus,$bookQuantity, $bookID);
    if ($result) {
        header("location:BookTable.php");
    } else {
        echo ' Please Check Your Query ';
    }
} else {
    header("location: BookTable.php");
}
