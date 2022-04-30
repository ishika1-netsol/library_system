<?php

include 'classes/Book.php';
$book = new Book();
if (isset($_GET['GetID'])) {
    $BookID = $_GET['GetID'];

    $result = $book->editBook($BookID);
  
    while ($row = $result->fetch_assoc()) {
        $bookID = $row['id'];
        $bookName = $row['book_name'];
        $authorName = $row['author_name'];     
        $bookStatus = $row['status'];
        $bookQuantity = $row['quantity'];
        $Created_at = $row['created_at'];
        $Updated_at = $row['updated_at'];

?>
        <?php require_once("header.php"); ?>

        <body>
            <div class="container-scroller">
                <!-- partial:partials/_sidebar.html -->
                <?php
                require_once("sideBar.php");
                require_once("navbar.php");
                ?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Update Form</h4>
                                        
                                        <form class="forms-sample" action="BookUpdate.php?ID=<?php echo $bookID ?>" method="post">
                                            <div class="form-group">
                                                <label> Book Name</label>
                                                <input type="text" class="form-control" placeholder=" Book Name " name="name" value="<?php echo $bookName ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Author Name</label>
                                                <input type="text" class="form-control" placeholder=" Author Name " name="author_name" value="<?php echo $authorName ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>select user_status:</label>
                                                <div class="form-check">
                                                    <label class="form-check-label" for="active"></label>
                                                    <input type="radio" class="form-check-input" id="issued" name="status" value="1" <?php if ($bookStatus == "1") {
                                                                                                                                            echo "checked";
                                                                                                                                        } ?>> Issued </label>
                                                    <label class="form-check-label" for="inactive"></label>
                                                    <input type="radio" class="form-check-input" id="return" name="status" value="0" <?php if ($bookStatus == "0") {
                                                                                                                                            echo "checked";
                                                                                                                                        } ?>> Return </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="text" class="form-control" placeholder="quantity" name="quantity" value="<?php echo $bookQuantity ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Created At</label>
                                                <input type="text" class="form-control" placeholder="Created At" name="created_at" value="<?php print date(" h:i d-F-Y", strtotime($Updated_at)) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Updated At</label>
                                                <input type="text" class="form-control" placeholder="Updated At" name="updated_at" value="<?php print date(" h:i d-F-Y", strtotime($Created_at)) ?> ">
                                            </div>
                                            <button class="btn btn-primary mr-2" name="update">Update</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </body>

<?php
    }
}
?>