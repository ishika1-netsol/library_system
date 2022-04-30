<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/userlogin.php");
    exit();
}

//Databse Connection file
require_once('classes/Book.php');
$book = new Book();

if (isset($_POST['create'])) {
    $bookName = $_POST['name'];
    $authorName = $_POST['authorName'];
    $target = "img/" . basename($_FILES['image']['name']); //foldername
    $image = $_FILES['image']['name']; // stored 
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    $query = $book->insertBook($bookName, $authorName, $image, $status, $quantity);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "image uploaded successfully";
    } else {
        $msg = "Error in image uploading";
    }
    if ($query) {
       
        header("Location: http://localhost/library%20system/BookTable.php");
    } else {
        echo 'Something Went Wrong. Please try again';
    }
}


require_once("header.php");
?>

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
                                <h4 class="card-title">Book Form</h4>
              
                                <form class="forms-sample" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">BookName</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="authorName">AuthorName</label>
                                        <input type="text" class="form-control" name="authorName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" class="form-control" name="quantity" required>
                                    </div>
                                    <div class="form-group">
                                        <label>select user_status:</label>
                                        <div class="form-check">
                                            <label class="form-check-label" for="active"></label>
                                            <input type="radio" class="form-check-input" id="issued" name="status" value="1"> Issued </label>
                                            <label class="form-check-label" for="inactive"></label>
                                            <input type="radio" class="form-check-input" id="return" name="status" value="0"> Return </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>File Upload</label>
                                        <input type="file" class="form-control" name="image" id="image" value="" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" id="load-button" name="create" value="submit">Submit</button>
                                    <button class="btn btn-dark" name="Cancel" type="submit" value="Cancel">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</body>