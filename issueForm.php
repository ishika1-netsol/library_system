<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/userlogin.php");
    exit();
}
require_once("./classes/Book.php");
$book = new Book();
include('./classes/Issue.php');
$issue = new Issue();
$result = $book->fetchAll();

$selection = array();
$selections = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $BookID = $row['id'];
        $BookName = $row['book_name'];
        $BookStatus = $row['status'];
        $BookQuantity = $row['quantity'];
        $Created_at = $row['created_at'];
        $Updated_at = $row['updated_at'];
        array_push($selection, $BookID);
        $selections[$BookID] = $BookName;
    }
}

if (isset($_GET['GetID'])) {
    $BookID = $_GET['GetID'];
}

$issuedates = array();

if (isset($_POST['create'])) {
    $IssueDate = $_POST['issue_date'];
    $ReturnDate = $_POST['return_date'];
    $BookID  = $_POST['book_id'];
    $UserID  = $_SESSION['id'];
    $status = 1;
    $quantity = $book->fetchQuantity($BookID);
     $counterDate = $IssueDate;
    while (strtotime($counterDate) <= strtotime($ReturnDate)) {                
        $IssuedCount = $issue->getIssuedBookCount($BookID, $IssueDate);
        $counterDate = date("Y-m-d",strtotime("+1 days", strtotime($counterDate)));              
        if ($IssuedCount >= $quantity) {
            $issuedates[] = $counterDate;          
        }
    }    
    echo "</br>";
    if (empty($issuedates)) {
        $query = $issue->insertIssues(date("Y-m-d",strtotime($IssueDate)), date("Y-m-d", strtotime($ReturnDate)), '', $BookID, $UserID, $status);                   
        header("Location:IssueTable.php");
        exit();
    } else {
        $error = $issuedates;
    }
}
?>
<?php require_once("header.php"); ?>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_sidebar.html -->
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
                                <h4 class="card-title">Issue Form</h4>
                         
                                <form class="forms-sample"  method="post">
                                    <?php if (isset($error)) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php
                                            echo implode(",", $error);
                                            echo '</br>';
                                            echo "Not available for this particular slot";
                                            ?></div>
                                    <?php
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label for="book_id">Choose a Book:</label>
                                        <select class="form-control" id="book_id" name="book_id">
                                            <option value="0">Please Select Option</option>
                                            <?php
                                            foreach ($selections as $book_id => $BookName) {
                                                $selected = ($book_id == $BookID) ? "selected" : "";
                                            ?>
                                                <option value="<?php echo $book_id ?>" <?php echo $selected ?>><?php echo $BookName ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="issue_date">IssueDate</label>
                                        <input type="text" id="issueDate" class="form-control"  name="issue_date" value="<?php echo isset($_POST['issue_date']) ? $_POST['issue_date'] : '' ?>" required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="return_date">ReturnDate</label>
                                        <input type="text" id="controlDate" class="form-control"  name="return_date" value="<?php echo isset($_POST['return_date']) ? $_POST['return_date'] : '' ?>" required autocomplete="off">
                                    </div>

                                    <input type="submit" class="btn btn-primary mr-2" name="create" value="submit">
                                    <button class="btn btn-dark" name="Cancel" type="submit" value="Cancel">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var disableDates = [];
        function DisableSpecificDates(date) {
            console.log(disableDates);
            var string = $.datepicker.formatDate('dd-mm-yy', date);
            console.log(string);
            console.log(disableDates.indexOf(string) == -1);
            return [disableDates.indexOf(string) == -1];
        }

        $(function() {      
            getDates(new Date().getFullYear(), new Date().getMonth() + 1);
            $("#controlDate").datepicker();
            $("#issueDate").datepicker({
                beforeShowDay: DisableSpecificDates,
                onSelect: function() {
                    console.log('s');
                },
                onChangeMonthYear: function(year, month) {
                    console.log(year, month);
                    getDates(year, month);
                }

            });
            $('#book_id').change(function() {
                getDates(new Date().getFullYear(), new Date().getMonth() + 1);
            })
        });

        function getDates(year, month) {        
            $.ajax({
                type: "POST",
                url: "data.php",
                async: false,
                data: {
                    book_id: $("#book_id").val(),
                    year: year,
                    month: month
                },
                success: function(result) {
                    var data = JSON.parse(result);                  
                    disableDates = [];
                    for (var item of data) {
                        disableDates.push(item);
                    }
                    console.log(disableDates);
                    $("#date").datepicker("beforeShowDay", DisableSpecificDates());
                }
            });           
        }
    </script>
</body>