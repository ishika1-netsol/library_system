<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/userlogin.php");
    exit();
}
include("classes/User.php");
$user = new User();
?>
<?php
require_once("header.php");
?>

<body>
    <div class="container-scroller">
        <?php
        require_once("sideBar.php");
        require_once("navbar.php");
        ?>     
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">User Table</h4>
                              
                                <form method="post" action="userExport.php">
                                    <input type="submit" name="export" value="CSV Export" class="btn btn-primary" />
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th>S.NO</th>                                              
                                                <th> User Name </th>
                                                <th> User Email</th>                                               
                                                <th> User Type </th>
                                                <th>Created_at </th>
                                                <th> Updated_at </th>
                                                <th>Edit </th>
                                                <th> Delete </th>
                                            </tr>
                                        </thead>
                                        <tbody class="users">
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php require_once('footer.php') ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <script>
        $(document).ready(function() {
            getdata();
            $(document).on("click", ".delete-btn", function() {
                if (confirm("Do you really want to delete this record ?")) {
                    var studentId = $(this).data("id");
                    console.log(studentId);
                    var element = this;
                    $.ajax({
                        type: "POST",
                        url: "ajax-delete.php",
                        data: {
                            id: studentId
                        },
                        success: function(response) {
                            if (response == 1) {                             
                                $(element).closest("tr").fadeOut();                              
                            } else {
                                alert("please check your query");
                            }
                        }
                    });
                }
            })
        });
        function getdata() {
            $.ajax({
                type: "POST",
                url: "fetchUser.php",
                success: function(response) {
                    $(".users").html(response);
                }
            });
        }        
    </script>
</body>

</html>





