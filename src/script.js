$(document).ready(function () {
    $("#register").validate({
        rules: {
            firstname: "required",          
            email: {
                required: true,
                email: true,
                remote : 'email.php?data=email',                            
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
                remote : "This Email id is already Exist",
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
    });
});

