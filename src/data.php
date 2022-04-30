<?php
include('./classes/Issue.php');
$issue = new Issue();
include('./classes/Book.php');
$book = new Book();
$result = $issue->fetchIssueDate();

$data = array();

if (isset($_POST['book_id'])) {
    $BookID = $_POST['book_id'];
}
if (isset($_POST['year'])) {
    $year = $_POST['year'];
}
if (isset($_POST['month'])) {
    $month = $_POST['month'];
}

$quantity = $book->fetchQuantity($BookID);

$issuedates = [];
$IssueDate = date('Y-m-01',strtotime($year.'-'.$month));
$ReturnDate = date('Y-m-t', strtotime($year . '-' . $month));

for ($i = $IssueDate; $i <= $ReturnDate; $i++) {

    $IssuedCount = $issue->getIssuedBookCount($BookID, $i);   

    if ($IssuedCount >= $quantity) {
        $issuedates[] = date('d-m-Y', strtotime($i));;
    }
}

echo json_encode($issuedates);
?>

