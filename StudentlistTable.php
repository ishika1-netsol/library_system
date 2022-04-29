<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/login.php");
    exit();
}
include("classes/Book.php");
$book = new Book();
?>

<?php
require_once("header.php");
?>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <?php
        require_once("sideBar.php");
        require_once("navbar.php");
        ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form action="Search.php" method="get">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                                                    echo $_GET['search'];
                                                                                } ?>" class="form-control" placeholder="search books">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                                <h4 class="card-title"> User Book Table</h4>
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th> Book ID </th>
                                                <th> Name </a></th>
                                                <th> AuthorName </th>
                                                <th> Book Image</th>
                                                <th> Status </th>
                                                <th> quantity </a></th>
                                                <th> Created_at </th>
                                                <th> Updated_at </th>
                                                <th> Request </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $number = 1;
                                            $result = $book->fetchAll();

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $BookID = $row['id'];
                                                    $BookName = $row['book_name'];
                                                    $AuthorName = $row['author_name'];
                                                    $BookImage  = $row['image'];
                                                    $BookStatus = $row['status'];
                                                    $BookQuantity = $row['quantity'];
                                                    $Created_at = $row['created_at'];
                                                    $Updated_at = $row['updated_at'];
                                            ?>
                                                    <tr>
                                                        <td><?php echo $number ?></td>
                                                        <td><?php echo $BookID ?></td>
                                                        <td><?php echo $BookName ?></td>
                                                        <td><?php echo $AuthorName ?></td>
                                                        <td><?php echo "<img src='img/" . $row['image'] . "' height=80px; width=60px: />" ?></td>
                                                        <td><?php
                                                            if ($BookStatus == '1') {
                                                                echo "issued";
                                                            } elseif ($BookStatus == '0') {
                                                                echo "return";
                                                            } ?></td>
                                                        <td><?php echo $BookQuantity ?></td>
                                                        <td><?php print date("h:i d-F-Y", strtotime($Created_at)) ?></td>
                                                        <td><?php print date(" h:i d-F-Y", strtotime($Updated_at)) ?></td>                                                       
                                                        <td><a href="issueForm.php?GetID=<?php echo $BookID ?>">Request</a></td>
                                                    </tr>
                                            <?php
                                                    $number++;
                                                }
                                            } else {
                                                echo "NO RECORDS";
                                            }

                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
               <?php require_once('footer.php')?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

</body>

</html>






