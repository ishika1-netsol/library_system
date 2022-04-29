<?php
include("classes/Book.php");
$book = new Book();
$result = $book->fetchAll();
$result_array = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($result_array, $row);
    }    
    echo json_encode($result_array);
} else {
    echo $return = "<h4>No Record Found</h4>";
}
?>



