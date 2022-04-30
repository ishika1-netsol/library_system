<?php
include("classes/User.php");
$user = new User();
$result = $user->fetchAll();
$output = "";
 $number = 1;
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
        <td>{$number}</td>   
       <td>{$row['name']}</td>
        <td>{$row['email']}</td>
         <td>{$row['user_type']}</td>
          <td>{$row['created_at']}</td>        
           <td>{$row['updated_at']}</td>  
           <td><a href='userEdit.php?GetID={$row['id']}'>Edit</a></td>
            <td><button class='delete-btn' data-id='{$row['id']}'>Delete</button></td>
           </tr>";
             $number++;
    }
    echo $output;
} else {
    echo $return = "<h4>No Record Found</h4>";
}
?>

