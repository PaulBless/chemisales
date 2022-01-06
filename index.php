 
<?php

    require_once 'db/db.php';

    ## Query 1 - Get Pharmacy Name
        $sql_system = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '1'")or die(mysqli_error($connect_db));
        $system = mysqli_fetch_assoc($sql_system);
        $get_pharmacy_name = $system['settings_ans'];

    // -- Query Ends Here

    ## Query 2 - Get System Title
        $sql_title = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '2'")or die(mysqli_error($connect_db));
        $title = mysqli_fetch_assoc($sql_title);
        $get_system_title = $title['settings_ans'];

    // -- Query Ends Here

    ## Query 3 - Get Pharmacy Address
        $sql_address = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '3'")or die(mysqli_error($connect_db));
        $address = mysqli_fetch_assoc($sql_address);
        $get_pharmacy_address = $address['settings_ans'];

    // -- Query Ends Here


    function sendEmail(){
        // Turn on output buffering
        // ob_start();
        //Get the ipconfig details using system commond
        // system('ipconfig /all');
        
        // Capture the output into a variable
        // $mycom=ob_get_contents();
        // Clean (erase) the output buffer
        // ob_clean();
        
        // $findme = "Physical";
        //Search the "Physical" | Find the position of Physical text
        // $pmac = strpos($mycom, $findme);
        
        // Get Physical Address
        // $mac=substr($mycom,($pmac+36),17);
        //Display Mac Address
        // echo $mac;

        // $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        // echo $actual_link;

        // $to_email = 'peterdonk17@gmail.com';
        // $subject = 'MAC Address during Trial Testing From: '.$actual_link;
        // $headers = 'From:'. $actual_link;
        // mail($to_email,$subject,$mac,$headers);

    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
    <title>ChemiSales | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A comprehensive retail pharmacy management software to automate pharmacy daily routines, for pharmacies and drug stores" name="description" />
    <meta content="Online Pharmacy Management System" name="Jecmas Technologies" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/pharmsolv-logo-sm-dark.jpg">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/ladda.css" rel="stylesheet" type="text/css" />
   
    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- Jquery Toast css -->
    <link href="assets/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
     
     <!-- Custom Script -->
    <script type="text/javascript" >
        function preventBack(){
            window.history.forward();
        }
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
            window.onhashchange=function(){
                window.location.hash="no-back-button";
                }
    </script> 
     
    <style type="text/css">
            .forgot-link{
                font-size: 13px; 
                padding: 0px;
            }

            .forgot-link label
            {
                margin: 0;
            }
            .forgot-link f-pwd{
                float: right;
            }
    </style>


</head>

    <!-- <body class="authentication-bg authentication-bg-pattern"> -->
    <body class="authentication-bg " style="background-image: linear-gradient(0deg, rgba(255, 0, 150, 0.3), rgba(255, 0, 150, 0.3)), url(assets/images/pharmacy.jpg); background-blend-mode: multiply;">

        <div class="account-pages mt-4 mb-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card" style="border: 1px solid #23b397;">

                            <div class="card-body p-4 ">
                                
                                <!-- <div class="text-center w-75 m-auto"> -->
                                <div class="text-center m-auto">
                                    <a href="index.php">
                                        <span><img src="assets/images/pharmsolv-dark.jpg" alt="PharmSolv" height="90" class="mt-0 mb-0"></span> 
                                    </a>
                                    <p class="text-dark font-weight-bold mb-1 mt-0"> <?php echo $get_system_title; ?>.</p>
                                </div>

                                <h5 class="auth-title text-success font-weight-bold" style="letter-spacing: 1px;"> <?php echo $get_pharmacy_name; ?> | <?php echo $get_pharmacy_address; ?></h5> 

                                <form id="login_form" method="POST" name="loginfrm" >
                                    <div class="col mb-1 text-center">                                 
                                        <span class="text-secondary font-weight-lighter">Welcome, enter username and password to continue</span>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent ">
                                                <span class="input-group-text bg-transparentt border-right-0 border-darkk">
                                                    <i class="mdi mdi-account-outline text-dark"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-md border-left-0 border-darkk text-dark" id="username" name="username" placeholder="Username" autofocus>                        
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 pass">
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent ">
                                                <span class="input-group-text bg-transparentt border-right-0 border-darkk">
                                                    <i class="mdi mdi-lock-outline text-dark"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control form-control-md border-left-0 border-darkk text-dark" id="password" name="password" placeholder="Password" >                        
                                        </div>
                                    </div>


                                    <div class="form-group mb-0 text-center" >
                                        <button class="btn btn-success btn-block ladda-button" type="submit" id="submit_button" data-style="slide-up" onclick="return validateform();"> <i class="mdi mdi-login"></i> Log In </button>
                                    </div>

                                </form><!-- end form -->

                            </div> <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <!-- Password Forgotten -->
                            <!-- <div class="row mt-0">
                                <div class="col-12 text-center">
                                    <p> Forgot your password? <a href="" class="text-muted ml-1">Click Here</a></p>
                                </div> 
                            </div> -->
                        <!-- End Password Forgotten -->
                         
                          <!-- <div class="forgot-link d-flex align-items-center justify-content-between font-weight-light">
                                <div class="form-check">
                                    <label for="remember" class="font-weight-light">Forgotten your password? Don't worry!</label>
                                 </div>
                            <a class="forgot-pwd font-weight-normal f-pwd " href="">Reset</a>
                        </div> -->
                        
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt bg-light">
           <label class="text-secondary font-weight-lighter">&copy; 2020 - <?php echo date('Y');?> - All rights reserved. Powered by </label> <a href="javascript:void(0)" target="_blank" class="text-dark font-weight-lighter">Jecmas </a> 
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
        
        <!-- Jquery Ui  -->
        <script src="assets/libs/jquery-ui/jquery-ui.min.js"></script>
        

        <script>

            function validateform()
            {
                if(document.loginfrm.username.value == "")
                {
                    $.toast({
                    text: "Username is required",
                    position: "top-center",
                    loaderBg: "#8a6d3b",
                    icon: "warning",
                    stack: "1"
                    });
                    document.loginfrm.username.focus();
                    return false;
                }
                else if(document.loginfrm.password.value == "")
                {
                    $.toast({
                    text: "Password is required",
                    position: "top-center",
                    loaderBg: "#8a6d3b",
                    icon: "warning",
                    stack: "1"
                    });
                    document.loginfrm.password.focus();
                    return false;
                }
                else if(document.loginfrm.password.value.length < 6)
                {
                    $.toast({
                        text: "Password length not complete",
                        position: "top-center",
                        loaderBg: "#8a6d3b",
                        icon: "warning",
                        stack: "1"
                    });
                    document.loginfrm.password.focus();
                    return false;
                }
            }
        </script>

        <script>
            $(document).ready(function(e) {
                    $("#username").focus(); 

                // prevent users from navigating back & forward
                function preventBack(){window.history.forward();}
                    setTimeout("preventBack()", 0);
                    window.onunload=function(){null};


                    var path = "index.php";
                    history.pushState(null, null, path + window.location.search), 
                    window.addEventListener("popstate", function(t) 
                    {
                        history.pushState(null, null, path + window.location.search)
                    });
        

                $("#login_form").submit(function(e) {                    

                    e.preventDefault();
                    var formdata = $(this).serialize();

                    var l = Ladda.create(document.querySelector('#submit_button'));
                    l.start();
                    $.ajax({
                        url: 'api_calls/login_api/login.php',
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
                                    'Access Denied', 
                                    'Sorry... your account has been Locked, Contact System Admin!', 
                                    'error'
                                );
                            } else if (res === 'error') {
                                l.stop();
                                Swal.fire(
                                    'Password Incorrect!', 
                                    'Ooops... Password does not match with the Username... Check and Try Again!', 
                                    'error'
                                );
                                $('#password').focus(); 
                                $('#password').select('');   
                                
                                // $('.pass').bounce({times: 3}, 200);

                            } else if (res === 'invalid') {
                                l.stop();
                                Swal.fire(
                                    'Username Incorrect!', 
                                    'The Username Is Wrong or Does Not Exists!', 
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

