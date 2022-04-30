<?php
require_once 'classes/Database.php';
class Book extends Database
{
    function insertBook($name, $author_name, $image, $status, $quantity)
    {
        $stmt = $this->_mysqli->prepare("INSERT INTO books (book_name,author_name,image,status,quantity )VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssssi", $name, $author_name, $image, $status, $quantity);
        return $stmt->execute();
    }
    function updateBook($name, $author_name, $status, $quantity, $id)
    {
        $stmt = $this->_mysqli->prepare("UPDATE books SET book_name=?,author_name=?,quantity=?,status=?  where id =?");
 
        $stmt->bind_param("sssii", $name, $author_name, $quantity, $status, $id);
        return $stmt->execute();
    }
    function deleteBook($id)
    {
        $stmt = $this->_mysqli->prepare("DELETE FROM books WHERE id=?");

        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    function fetchBook($order,$sort)
    {
        $stmt = $this->_mysqli->prepare('SELECT * FROM books ORDER BY '.$order.' '.$sort);
 
        $stmt->execute();
        $query = $stmt->get_result();     
        return $query;
    }
    function editBook($id)
    {
        $stmt = $this->_mysqli->prepare("SELECT * FROM books WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $query = $stmt->get_result();
        return $query;
    }
    function insertIssues($book_id, $user_id)
    {
        $stmt = $this->_mysqli->prepare("INSERT INTO issues (book_id,user_id )VALUES (?,?)");
        $stmt->bind_param("ii", $book_id, $user_id);
        return $stmt->execute();
    }
    function fetchQuantity($book_id){
        $stmt = $this->_mysqli->prepare("SELECT quantity FROM books WHERE id =?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $query = $stmt->get_result();
        $row = $query->fetch_assoc();
        $result = $row['quantity'];
        return $result;
    }
     function searchBook($name){
        $stmt = $this->_mysqli->prepare("SELECT * FROM books WHERE book_name  LIKE '%$name%' OR  author_name LIKE '%$name%' ");   
        $stmt->execute();
        $query = $stmt->get_result();
        return $query;
     }
    function fetchAll()
    {
        $stmt = $this->_mysqli->prepare('SELECT * FROM books ');
        $stmt->execute();
        $query = $stmt->get_result();       
        return $query;
    }
   
}
?>