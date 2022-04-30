<?php
require_once 'classes/Database.php';
class Issue extends Database
{
    function insertIssues($issue_date, $return_date, $actual_return, $book_id, $user_id, $status)
    {
        $stmt = $this->_mysqli->prepare("INSERT INTO issues (issue_date,return_date,actual_return,book_id,user_id,status ) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssss", $issue_date, $return_date, $actual_return, $book_id, $user_id, $status);
        return $stmt->execute();
    }

    function getIssuedBookCount($book_id, $issue_date)
    {
        $stmt = $this->_mysqli->prepare("SELECT count(*) FROM `issues` WHERE status = 1 AND book_id = ? AND (? between date(issue_date)  AND date(return_date))");
        $stmt->bind_param("is", $book_id, $issue_date);
        $stmt->execute();
        $query = $stmt->get_result();
        $row = $query->fetch_assoc();
        $saved = $row['count(*)'];
        return $saved;
    }
    function fetchBookDates($book_id)
    {
        $stmt = $this->_mysqli->prepare("SELECT * FROM issues WHERE book_id =?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $query = $stmt->get_result();
        return $query;
    }
    function fetchAll()
    {
        $stmt = $this->_mysqli->prepare('SELECT * FROM issues ORDER BY return_date desc');
        $stmt->execute();
        $query = $stmt->get_result();
        return $query;
    }
    function Joins()
    {
        $stmt = $this->_mysqli->prepare('SELECT books.book_name,users.name, issues.issue_date,issues.return_date,issues.status,issues.created_at,issues.updated_at FROM `issues` RIGHT JOIN users ON issues.user_id = users.id RIGHT JOIN books ON issues.book_id = books.id');
        $stmt->execute();
        $query = $stmt->get_result();
        return $query;
    }

    function fetchIssueDate()
    {
        $stmt = $this->_mysqli->prepare('SELECT issue_date FROM `issues` WHERE status = 1');
        $stmt->execute();
        $query = $stmt->get_result();
        return $query;
    }
}
?>

