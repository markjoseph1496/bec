<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Berlein Electronics Corp.</title>

    <!-- Bootstrap -->
    <link href="src/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="src/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="src/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="src/animate.css/animate.min.css" rel="stylesheet">
    <!-- Bootstrap Validator -->
    <link href="src/validator/bootstrapValidator.min.css">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form id="LoginForm" method="post" autocomplete="off">
                    <h1>Login</h1>
                    <div id="LoginError" class="alert alert-danger alert-dismissible fade in" role="alert" style="display: none">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        Account doesn't exists. Please Try again.
                    </div>
                    <div class="form-group">
                        <input type="text" name="Username" id="Username" class="form-control" placeholder="Username"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="Password" id="Password" class="form-control" placeholder="Password"/>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default" href="">Log in</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div>
                            <h1>Berlein Electronics Corp.</h1>
                            <p>©2016 All Rights Reserved.</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="src/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="src/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="src/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="src/nprogress/nprogress.js"></script>
<!-- validator -->
<script src="src/validator/bootstrapValidator.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="build/js/custom.min.js"></script>

<!-- validator -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#LoginForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                invalid: 'glyphicon glyphicon-remove'
            },
            fields: {
                group: 'form-group',
                Username: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your username.'
                        }
                    }
                },
                Password: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your password.'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'functions/login.php',
                data: $('#LoginForm').serialize(),
                success: function (data) {
                    var result = $.parseJSON(data);
                    if(result.Count == 0){
                        $('#Username').val("");
                        $('#Password').val("");
                        $('#LoginError').show();
                        $("#LoginError").fadeTo(5000, 500).slideUp(500, function () {

                        });
                    }
                    else{
                        if(result.AccountType == "Admin"){
                            alert("Login Success!");
                            window.location.href = "pages/ad/admin.php";
                        }
                        else if(result.AccountType == "Cashier"){
                            alert("Login Success!");
                            window.location.href = "pages/cs/plain_page.php";
                        }
                        else if(result.AccountType == "Area Manager"){
                            alert("Login Success!");
                            window.location.href = "pages/am/plain_page.php";
                        }
                    }
                }
            })
        });
    });
</script>
</body>
</html>
