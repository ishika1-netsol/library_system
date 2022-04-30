<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/userlogin.php");
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
                                <h4 class="card-title">Book Table</h4>
                                <form method="post" action="bookExport.php">
                                    <input type="submit" name="export" value="CSV Export" class="btn btn-primary" />
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th> Book ID </th>
                                                <th> Name </th>
                                                <th> AuthorName </th>
                                                <th> Book Image</th>
                                                <th> Status </th>
                                                <th> quantity </th>
                                                <th> Created_at </th>
                                                <th> Updated_at </th>
                                                <th> Edit </th>
                                                <th> Delete </th>
                                            </tr>
                                        </thead>
                                        <tbody class="books">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php require_once("footer.php"); ?>
                <!-- partial -->
                <!-- Modal -->
                <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="BookDelete.php" method="post">
                                <input type="hidden" name="delete_id" class="delete_user_id">
                                <div class="modal-body">
                                    Are you sure. you want to delete this data?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="deleteUserbtn" class="btn btn-primary">Yes,Delete!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php require_once("script.php"); ?>
    <script>
        $(document).ready(function() {
            getdata();
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var user_id = $(this).val();
                console.log(user_id);
                $('.delete_user_id').val(user_id);
                $('#DeleteModal').modal('show');
            });

        });

        function getdata() {
            $.ajax({
                type: "get",
                url: "bookFetch.php",
                success: function(response) {
                    response = JSON.parse(response);                 
                    $.each(response, function(key, value) {      
                        $('.books').append('<tr>' +
                            '<td>' + value['id'] + '</td>\
                            <td>' + value['book_name'] + '</td>\
                                 <td>' + value['author_name'] + '</td>\
                                 <td> <img src="img/' + value['image'] + '" height="80px" width="60px"/></td>\
                                   <td>' + value['status'] + '</td>\
                                    <td>' + value['quantity'] + '</td>\
                                      <td>' + value['created_at'] + '</td>\
                                        <td>' + value['updated_at'] + '</td>\
                                        <td><a href="Bookedits.php?GetID=' + value['id'] + '">Edit</a></td>\
                                        <td><button type="button" value="' + value['id'] + '" class="btn btn-danger btn-sm delete-btn" name="button">Delete</button></td>\
                                         </tr>');
                    });
                }
            });

        }
    </script>
    
</body>

</html>