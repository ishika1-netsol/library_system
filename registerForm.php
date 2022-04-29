<?php
require_once('header.php');
?>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Register</h3>
                            <form id="register">
                                <div class="form-group">
                                    <label for="firstname">Username</label>
                                    <input type="text" id="name" class="form-control p_input" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" class="form-control p_input checking_email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">

                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control p_input" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">

                                </div>
                                <div class="form-group">
                                    <label for="cpassword"> Confirm Password</label>
                                    <input type="password" class="form-control p_input" id="cpassword" value="<?php echo isset($_POST['cpassword']) ? $_POST['cpassword'] : '' ?>">

                                </div>
                                <div class="form-group">
                                    <label for="user_type">Choose a user:</label>
                                    <select class="form-control p_input" id="user_type" value="<?php echo isset($_POST['user_type']) ? $_POST['user_type'] : '' ?>">
                                        <option value="student">Student</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary btn-block enter-btn" id="submit" value="submit">
                                </div>
                                <p class="sign-up text-center">Already have an Account?<a href="userlogin.php">Login</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>

        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <script>
        $(document).ready(function() {

            $("#register").validate({
                rules: {
                    firstname: "required",
                    email: {
                        required: true,
                        email: true,
                        remote: 'email.php?data=email',
                    },
                    password: {
                        required: true,
                        minlength: 6,
                    },
                    cpassword: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    }
                },
                messages: {
                    firstname: "Please enter your name",
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email format",
                        remote: "This Email id is already Exist",
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Please enter password of minimum length of 6 characters"
                    },
                    cpassword: {
                        required: "Please enter your password",
                        minlength: "Please enter password of minimum length of 6 characters",
                        equalTo: "Password does not match"
                    }

                },
                submitHandler: function(form) {
                    // alert('hello');
                    var name = $("#name").val();
                    var email = $("#email").val();
                    var password = $("#password").val();
                    var cpassword = $("#cpassword").val();
                    var user_type = $("#user_type").val();
                    $.ajax({
                        type: "POST",
                        url: "ajax-insert.php",
                        data: {
                            firstname: name,
                            Email: email,
                            Pass: password,
                            confirm: cpassword,
                            user: user_type,
                        },

                        success: function(response) {
                            if (response == 1) {
                                window.location = "userlogin.php?successful=true";
                            } else {
                                alert('cannot see records');
                            }
                        }
                    });
                }
            });
        })
    </script>

</body>