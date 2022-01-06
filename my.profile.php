<?php  

    require_once 'session.php'; // check if user is authenticated

    require_once 'db/db.php'; 
    require_once 'template/header.manager.php'; 
    require_once 'template/topnav.manager.php'; 
    require_once 'template/menu.manager.php'; 



// Get Profile ID of logged user
$profileId = "";
if(isset($_SESSION['user']))
    $profileId = $_SESSION['user'];

    

?>


<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0" style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Manager</a></li>
                                <li class="breadcrumb-item active">My Profile </li>
                            </ol>

                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">My Account</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <!-- Edit Profile -->
            <div class="row">
                <div class="col-md-6">
                     <div class="card-box">
                     <p class="text-dark text-center font-weight-bold" style="letter-spacing: 0.5px;"> Edit Profile</p>
                        <form action="" method="post" id="profile-form" >
                            <div class="row">
                                <div class="row col-12">
                                    
                                    <div class="form-group mb-12 col-md-12 d-none">
                                        <label for="txt_from">ID:</label>
                                        <input type="text" id="id" name="id" value="<?php echo $profileId; ?>" class="form-control" readonly>
                                    </div>
                                    
                                    <div class="form-group mb-12 col-md-12 d-none">
                                        <label for="txt_from">User ID:</label>
                                        <input type="text" id="userid" name="userid" value="<?php echo $userid; ?>" class="form-control" readonly>
                                    </div>
                                    
                                    <div class="form-group mb-12 col-md-12">
                                        <label for="txt_from">Firstname:</label>
                                        <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>"
                                            class="form-control" placeholder="Enter Firstname" onkeypress="return acceptLetters(this.event);" required>
                                    </div>

                                    <div class="form-group mb-12 col-md-12">
                                        <label for="txt_to">Lastname:</label>
                                        <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>"
                                            class="form-control" placeholder="Enter Lastname" onkeypress="return acceptLetters(this.event);" required>
                                    </div>

                                    <div class="form-group mb-12 col-md-12">
                                        <label for="txt_to">Phone Number:</label>
                                        <input type="text" id="phonenumber" name="phonenumber" value="<?php echo $phone; ?>"
                                            class="form-control" placeholder="Enter phone number" maxLength="10" pattern="[0][0-9]{9}" onkeypress="return isNumberKey(event);" required>
                                    </div> 
                                    
                                    <div class="form-group mb-12 col-md-12">
                                        <label for="txt_to">User Name:</label>
                                        <input type="text" id="username" name="username" value="<?php echo $loginid; ?>"
                                            class="form-control" placeholder="Enter username" required>
                                    </div>


                                </div>
                            </div>
                                                                                        
                            <div class="row d-flex justify-content-center">
                                <button class="btn btn-primary waves-effect text-center mr-2" type="submit" name="save" id="save">Save Changes </button>
                                <!-- <button class="btneturn window.location.href='admin.dashboard.php'">Cancel < btn-secondary waves-effect" type="button" onclick="r/button> -->
                            </div>
                        </form>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
            
            <!-- Reset Password -->
            <div class="row pt-2">
                <div class="col-md-6">
                     <div class="card-box">
                     <p class="text-dark text-center font-weight-bold" style="letter-spacing: 0.5px;"> Reset Your Password</p>
                        <form action="" method="post" id="password-form" >
                            <div class="row">
                                <div class="row col-12">

                                    <input type="hidden" class="form-control" name="uid" value="<?php echo $profileId; ?>">
                                    
                                    <div class="form-group mb-12 col-md-12">
                                        <label for="txt_from">Current Password:</label>
                                        <input type="password" id="current_password" name="current_password"
                                            class="form-control" placeholder="enter current password" required>
                                    </div>

                                    <div class="form-group mb-12 col-md-12">
                                        <label for="txt_to">New Password:</label>
                                        <input type="password" id="new_password" name="new_password"
                                            class="form-control" placeholder="enter new password" required>   
                                             <small id="pass_strength" data-status=''></small>
                                    </div>

                                    <div class="form-group mb-12 col-md-12">
                                        <label for="txt_to">Confirm New Password:</label>
                                        <input type="password" id="confirm_password" name="confirm_password"
                                            class="form-control" placeholder="confirm new password" required>
                                            <small id="pass_match" data-status=''></small>
                                    </div>
                                </div>
                            </div>
                                                                                        
                            <div class="row d-flex justify-content-center">
                                <button class="btn btn-pink waves-effect text-center mr-2" type="submit" name="save" id="save">Reset Password </button>
                                <!-- <button class="btn btn-secondary waves-effect" type="button" onclick="return window.location.href='admin.dashboard.php'">Cancel </button> -->
                            </div>
                        </form>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
            

        </div> <!-- container -->

    </div> <!-- content -->


    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {

        // render form submit
        $('#profile-form').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

                $.ajax({
                    url: 'api_calls/profile_api/update.profile.php',
                    type: 'POST',
                    data: formdata,
                    success: function(res) {
                        if(res === 'success')
                        {
                            swal.fire(
                                'Great!', 
                                'Your Profile has been updated successfully..', 
                                'success').then(function() {
                                window.location.href = 'my.account.php'
                            });
                        }else{
                            Swal.fire(
                            'Ooops',
                            'Something went wrong ajax error !',
                            'error').then(function() {
                                window.location.href = 'my.account.php'
                            });
                        }
                      
                    },
                    error: function(res) {
                        console.log(res);  
                        $.toast({
                            heading: "Error",
                            text: "Sorry, something went wrong while updating profile",
                            position: "top-right",
                            loaderBg: "#bf441d",
                            icon: "error",
                            stack: "4"
                        });
                    }
            });
        });

        // render form submit
        $('#password-form').submit(function(e) {
            e.preventDefault();
            
            var formdata = $(this).serialize();

                $.ajax({
                    url: 'api_calls/profile_api/update.password.php',
                    type: 'POST',
                    data: formdata,
                    success: function(res) {
                        if(res === 'success')
                        {
                            swal.fire(
                                'Great!', 
                                'Password Has Been Changed.. Kindly login again with your new password', 
                                'success').then(function() {
                                window.location.href = 'logout.php'
                            });
                        }else if (res === 'incorrect'){
                            Swal.fire(
                            'Sorry!',
                            'Your Current Password is Incorrect!! Please Check and Try Again..',
                            'error').then(function() {
                                window.location.href = 'my.account.php'
                            });
                        }else if (res === 'error'){
                            Swal.fire(
                            'Ooops',
                            'Please Check your current password and try again...',
                            'error');
                        }
                      
                    },
                    error: function(res) {
                        console.log(res);  
                        $.toast({
                            heading: "Error",
                            text: "Sorry, something went wrong while updating password..",
                            position: "top-right",
                            loaderBg: "#bf441d",
                            icon: "error",
                            stack: "4"
                        });
                    }
                });
        });

        // saves new medicine
        $('#add-medicine').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

                $.ajax({
                    url: 'api_calls/medicine_api/add.medicine.php',
                    type: 'POST',
                    data: formdata,
                    success: function(res) {
                        if(res === 'success')
                        {
                        swal.fire(
                            'Great!', 
                            'Medicine added successfully..', 
                            'success').then(function() {
                            window.location.href = 'medicine.entry.php'
                            clearForm();
                        });
                        }
                        else if (res === 'exist')
                        {
                            swal.fire(
                                'Error!', 
                                'This medicine is already added or exists', 
                                'error').then(function() {
                                window.location.href = 'medicine.entry.php'
                            });
                        }
                        else{
                            Swal.fire(
                            'Ooops',
                            'Something went wrong while adding record',
                            'error').then(function() {
                                window.location.href = 'medicine.entry.php'
                            });
                        }
                      
                    },
                    error: function(res) {
                        console.log(res);  
                        $.toast({
                            heading: "Error",
                            text: "Sorry, something went wrong while adding the record",
                            position: "top-right",
                            loaderBg: "#bf441d",
                            icon: "error",
                            stack: "4"
                        });
                    }
            });
        });

       

    });

function clearForm(){
    $("#medicine-category").val(null).trigger("change");  //reset dropdown
    $("#generic-name").val(null).trigger("change");  //reset dropdown
    $("#dosage").val('');
    $("#package-size").val('');
    $("#brand-name").val('');
    $("#medicine-name").val('');
    $("#description").val('');
    $("#cost-price").val('');
    $("#selling-price").val('');
    $("#mfg-date").val('');
    // $("#supplier-name").selectedIndex = 0;
}
  
    </script>

<script>
    // check password identity
    $('[name="new_password"],[name="confirm_password"]').keyup(function(){
      var pass = $('[name="new_password"]').val()
      var cpass = $('[name="confirm_password"]').val()

      if(cpass == '' || pass == ''){
        $('#pass_match').attr('data-status','')
      }else{
        if(cpass == pass){
          $('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>');
          $('[name="new_password"],[name="confirm_password"]').css("borderColor", "#23b397");
        }else{
          $('#pass_match').attr('data-status','2').html('<i class="text-danger">Passwords does not match.</i>')
          $('[name="confirm_password "],[name="new_password"]').css("borderColor", "#f0643b");
        }
      }

    })

    // check password length
    $('[name="new_password"],[name="confirm_password"]').blur(function(){
        var length1 = $('#new_password').val();
        var length2 = $('#confirm_password').val();

         // check passwords length
      if( $('#new_password').val() == ''){
        $('#pass_strength').attr('data-status', '')
      }else{
          if(length1.length >= 6){
            $('#pass_strength').attr('data-status', '1').html('<i class="text-primary">Password is Strong.</i>');
          }else{
              $('#pass_strength').attr('data-status', '2').html('<i class="text-danger">Password Length Weak..</i>');
              $('#new_password').focus();
          }
      }
    })

</script>
