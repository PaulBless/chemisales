<?php

require_once 'session.php';
require_once 'db/db.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>PharmSolv | Lock</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A powerful, fully fledged pharmacy management system to daily pharmacy routines, for pharmacies and drug stores" name="description" />
    <meta content="Online Pharmacy Management & Billing System" name="JecmasTechnologies" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/pharmsolv-logo-sm-light.png">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/ladda.css" rel="stylesheet" type="text/css" />
   
    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- Jquery Toast css -->
    <link href="assets/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
         
    <script type="text/javascript" >
        function preventBack(){window.history.forward();}
            setTimeout("preventBack()", 0);
            window.onunload=function(){null};
    </script>
         
         <script>
            var path = "index.php";
            history.pushState(null, null, path + window.location.search), window.addEventListener("popstate",
            function(t) {
                history.pushState(null, null, path + window.location.search)
            });
         </script>
         
         <script>
            window.location.hash="no-back-button";
            window.location.hash="Again-No-back-button"; //again because google chrome don't insert first hash into history
            window.onhashchange=function(){window.location.hash="no-back-button";}
        </script> 

</head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-3">

                                <div class="text-center mb-2">
                                    <a href="index.php">
                                        <span><img src="assets/images/pharmsolv-dark.jpg" alt="PharmSolv" height="60"></span>
                                    </a>
                                </div>

                                <div class="text-center w-75 m-auto">
                                    <img src="assets/images/default.png" width="88" alt="user-image" class="rounded-circle img-thumbnail">
                                    <h4 class="text-dark-50 text-center mt-1">Hi, <?php echo $users_fullname; ?>! </h4>
                                </div>

                                <form id="lock_form" method="post">
                                    <input type="text" value="<?php echo $loginid;?>" name="username" class="form-control d-none"/>

                                    <div class="form-group mb-3">
                                    <p class="text-center mb-1">Kindly enter your password to access system</p>
                                        <input class="form-control text-center" type="password" id="password" name="password" placeholder="Password" requiredd="" >
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block ladda-button" type="submit" data-style="slide-up" id="submit_button" > Log In </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Not you? return <a href="index.php"  class="text-muted ml-1"><b class="font-weight-semibold">Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
            2019 &copy; Developed by <a href="http://www.jecmasgh.com" class="text-muted">Jecmas</a> 
        </footer>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

         <!-- Jquery js-->
        <script src="assets/js/jquery.min.js"></script>

        <!-- ladda -->
        <script src="assets/js/ladda.js"></script>

        <!-- Sweet Alerts js -->
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- Toast Js-->
        <script src="assets/libs/jquery-toast/jquery.toast.min.js"></script>
        


<script type="text/javascript">

    $(document).ready(function(e){
        $("#password").focus(); 

        function preventBack(){window.history.forward();}
            setTimeout("preventBack()", 0);
        window.onunload=function(){null};

        $(document).on('click', '#submit_button', function(){
            if($('#password').val() == ""){
                Swal.fire(
                    'Ooops!', 
                    'Sorry... kindly enter your password!', 
                    'error'
                );
            }
        });

        $("#lock_form").submit(function(e){
            e.preventDefault();
            var formdata = $(this).serialize();

            var l = Ladda.create(document.querySelector('#submit_button'));
            l.start();
            $.ajax({
                            url: 'api_calls/lock_api/lock.php',
                            type: 'POST',
                            data: formdata,
                            success: function(res) {
                                console.log(res);
                                if (res === "success") {
                                    l.stop();
                                    $.toast({
                                        text: "Login Successful",
                                        position: "top-right",
                                        loaderBg: "#5ba035",
                                        icon: "success",
                                        stack: "1"
                                    });
                                    window.location.href = "access-control.php";
                                } else if (res === "locked") {
                                    l.stop();
                                    $('#username').val('');
                                    $('#password').val('');
                                    Swal.fire(
                                        'Unauthorized!', 
                                        'Sorry... your account is currently Locked, Contact System Admin!', 
                                        'error'
                                    );
                                } else if (res === 'error') {
                                    l.stop();
                                    Swal.fire(
                                        'Unauthorized!', 
                                        'Sorry... Password is Invalid for this Login ID, Check and Try Again!', 
                                        'error'
                                    );
                                    $('#password').focus(); 
                                
                                } else if (res === 'invalid') {
                                    l.stop();
                                    Swal.fire(
                                        'Unauthorized!', 
                                        'Ooops... It seems this Account does not exists!', 
                                        'error'
                                    );
                                    $('#username').val('');
                                    $('#password').val(''); 
                                }

                            },
                            error: function(res) {
                                $.toast({
                                    heading: "System Error",
                                    text: "Could not process request... ajax error!",
                                    position: "top-right",
                                    loaderBg: "#bf441d",
                                    icon: "error",
                                    stack: "1"
                                });
                            }

            });

        });

    });


</script>

        
    </body>
</html>