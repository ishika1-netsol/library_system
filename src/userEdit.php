  <?php
   
    include 'classes/User.php';
    $user = new User();
    if (isset($_GET['GetID'])) {
        $UserID = $_GET['GetID'];

        $result = $user->editUser($UserID);

        while ($row = $result->fetch_assoc()) {
            $UserID = $row['id'];
            $UserName = $row['name'];
            $UserEmail = $row['email'];

            $UserStatus = $row['status'];
            $UserType = $row['user_type'];
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
                                       
                                          <form class="forms-sample" action="update.php?ID=<?php echo $UserID ?>" method="post">
                                              <div class="form-group">
                                                  <label>Name</label>
                                                  <input type="text" class="form-control" placeholder=" User Name " name="name" value="<?php echo $UserName ?>">
                                              </div>
                                              <div class="form-group">
                                                  <label>Email</label>
                                                  <input type="text" class="form-control" placeholder=" User Email " name="email" value="<?php echo $UserEmail ?>">
                                              </div>
                                              <div class="form-group">
                                                  <label for="user_type">Choose a user:</label>
                                                  <select class="form-control" id="user_type" name="user_type">
                                                      <option value="student" <?php if ($UserType == "student") {
                                                                                    echo "selected";
                                                                                } ?>>Student</option>
                                                      <option value="admin" <?php if ($UserType == "admin") {
                                                                                echo "selected";
                                                                            } ?>>Admin</option>
                                                  </select>
                                              </div>
                                              <div class="form-group">
                                                  <label>select user_status:</label>
                                                  <div class="form-check">
                                                      <label class="form-check-label" for="active"></label>
                                                      <input type="radio" class="form-check-input" id="active" name="status" value="1" <?php if ($UserStatus == "1") {
                                                                                                                                            echo "checked";
                                                                                                                                        } ?>> Active </label>
                                                      <label class="form-check-label" for="inactive"></label>
                                                      <input type="radio" class="form-check-input" id="inactive" name="status" value="0" <?php if ($UserStatus == "0") {
                                                                                                                                                echo "checked";
                                                                                                                                            } ?>> Inactive </label>
                                                  </div>
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