<?php  

    // Include Files
    require_once 'session.php';  
    
    // Role Based Access Management
    if($users_role === '1'){
        require_once 'db/db.php'; 
        require_once 'template/header.admin.php'; 
        require_once 'template/topnav.admin.php'; 
        require_once 'template/menu.admin.php'; 

     }else if ($users_role === '2'){
        require_once 'db/db.php'; 
        require_once 'template/header.manager.php'; 
        require_once 'template/topnav.manager.php'; 
        require_once 'template/menu.manager.php'; 
    }else{
        echo "<script>window.location.href='index.php'</script>";
    }
     

?>

<?php 
    // Query Database For Settings Information
    $get_system_name = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 1") or die(mysqli_error($connect_db));
    $get_name = mysqli_fetch_array($get_system_name);
    $system_name = $get_name['settings_ans'];

    // app title
    $get_system_title = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 2") or die(mysqli_error($connect_db));
    $get_title = mysqli_fetch_array($get_system_title);
    $system_title = $get_title['settings_ans'];

    // pharmacy address
    $get_address = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 3") or die(mysqli_error($connect_db));
    $get_address_item = mysqli_fetch_array($get_address);
    $address = $get_address_item['settings_ans'];

    // pharmacy contact number
    $get_contact = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 4") or die(mysqli_error($connect_db));
    $get_contact_item = mysqli_fetch_array($get_contact);
    $contact = $get_contact_item['settings_ans'];

    // pharmacy email
    $get_email = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 5") or die(mysqli_error($connect_db));
    $get_email_item = mysqli_fetch_array($get_email);
    $email = $get_email_item['settings_ans'];

    // quantity alert limt 
    $get_quantity_alert = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 6") or die(mysqli_error($connect_db));
    $get_quantity_alert_item = mysqli_fetch_array($get_quantity_alert);
    $quantity_alert = $get_quantity_alert_item['settings_ans'];

    // currency value symbol
    $get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
    $get_currency_item = mysqli_fetch_array($get_currency);
    $currency = $get_currency_item['settings_ans'];

    // expire alert limit 
    $get_expire_alert = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 8") or die(mysqli_error($connect_db));
    $get_expire_alert_item = mysqli_fetch_array($get_expire_alert);
    $expire_alert = $get_expire_alert_item['settings_ans'];

    // invoice due date
    $get_invoice_due = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 9") or die(mysqli_error($connect_db));
    $get_invoice_due_item = mysqli_fetch_array($get_invoice_due);
    $invoice_due = $get_invoice_due_item['settings_ans'];

    // get pharmacy logo
    $get_profile_pic = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 10") or die(mysqli_error($connect_db));
    $get_profile_pic_item = mysqli_fetch_array($get_profile_pic);
    $profile = $get_profile_pic_item['settings_ans']; 
    
    // get printer option
    $get_printer_option = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 11") or die(mysqli_error($connect_db));
    $get_printer_item = mysqli_fetch_array($get_printer_option);
    $printer = $get_printer_item['settings_ans'];  
    
    // get barcode scanner option
    $get_barcode_option = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 12") or die(mysqli_error($connect_db));
    $get_barcode_item = mysqli_fetch_array($get_barcode_option);
    $barcode = $get_barcode_item['settings_ans'];

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
                                        <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                        <li class="breadcrumb-item active"> Settings Configuration</li>
                                        </ol> 
                                    </div>
                                    <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Settings</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
        
                        <div class="row">
                        <div class="col-12">
                            
                            <div class="card-box" >
                                <form method="post" id="settings-form" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-md-12 col-sm-12 text-center">
                                    <label class="newbtn" style="cursor:pointer;">
                                        <img id="setUrl" src="assets/images/<?php echo $profile; ?>" height="100px" width="100px" class="mr-4" style="border-radius: 50%; border: 2px solid #14324d" title="Click to Upload Logo">
                                        <input id="pic" type="file" style="display: none" name="profileImage">
                                    </label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group mb-3">
                                                        <label for="txt_system_name">Shop or Pharmacy Name</label>
                                                        <input type="text" autocomplete="off" id="txt_system_name" name="txt_system_name" value="<?php echo $system_name; ?>" class="form-control" required>
                                                    </div>   
                                             </div> <!-- end col -->

                                             <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="txt_system_title">Application Title</label>
                                                <input type="text" autocomplete="off" id="txt_system_title" value="<?php echo $system_title ? : 'Chemical Shop Management System'; ?>" name="txt_system_title" class="form-control" value="Pharmacy Management & Billing System" readonly>
                                            </div>    
                                     </div> <!-- end col -->

                                  
                              
                            </div> <!-- end card-box -->

                            <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group mb-3">
                                                    <label for="txt_address">Shop Address</label>
                                                    <textarea required id="txt_address" name="txt_address" class="form-control" rows="2"><?php echo $address;?></textarea>
                                                    </div>  
                                             </div> <!-- end col -->
                            </div> <!-- end card-box -->

                            <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group mb-3">
                                                        <label for="txt_contact">Phone Number</label>
                                                        <input type="text" autocomplete="off" id="txt_contact" value="<?php echo $contact; ?>" name="txt_contact" required id="simpleinput" class="form-control">
                                                    </div>   
                                             </div> <!-- end col -->

                                             <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="txt_pharmacy_email"> E-Mail Address</label>
                                                <input type="email" autocomplete="off" id="txt_pharmacy_email" value="<?php echo $email; ?>" name="txt_pharmacy_email" class="form-control" required>
                                            </div>    
                                     </div> <!-- end col -->
 
                            </div> <!-- end card-box -->

                            <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group mb-3">
                                                        <label for="txt_min_quantity_alert">Minimum Quantity (<span class="text-danger"> For Stock Alert </span>) </label>
                                                        <input type="text" autocomplete="off" id="txt_min_quantity_alert" value="<?php echo $quantity_alert; ?>" name="txt_min_quantity_alert" class="form-control" required>
                                                    </div>   
                                             </div> <!-- end col -->

                                             <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="sel_currency">Currency Symbol </label>
                                                <select id="sel_currency" name="sel_currency" class="selectpicker" data-style="btn-outline-success" required>
                                                    <option value="GH¢" <?php  if($currency === 'GH¢'){ echo 'selected';}else{}?>>GH¢</option>
                                                    <option value="$" <?php  if($currency === '$'){ echo 'selected';}else{}?>>$</option>
                                                </select>
                                            </div>    
                                     </div> <!-- end col -->
 
                            </div> <!-- end card-box -->

                            <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group mb-3">
                                                        <label for="sel_expire_alert_limit">Expire Alert Limit (<span class="text-danger"> Months </span>) </label>
                                                        <select id="sel_expire_alert_limit" name="sel_expire_alert_limit" class="selectpicker" data-style="btn-outline-success" required>
                                                    <option value="1" <?php  if($expire_alert === '1'){ echo 'selected';}else{}?>>1 month</option>
                                                    <option value="2" <?php  if($expire_alert === '2'){ echo 'selected';}else{}?>>2 months</option>
                                                    <option value="3" <?php  if($expire_alert === '3'){ echo 'selected';}else{}?>>3 months</option>
                                                    <option value="4" <?php  if($expire_alert === '4'){ echo 'selected';}else{}?>>4 months</option>
                                                </select>
                                                    </div>   
                                             </div> <!-- end col -->

                                             <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="sel_invoice_due">Invoice Due Date</label>
                                                <select class="selectpicker" data-style="btn-outline-success" id="sel_invoice_due" name="sel_invoice_due">
                                                    <option value="7" <?php  if($invoice_due === '7'){ echo 'selected';}else{}?>>1 week</option>
                                                    <option value="14" <?php  if($invoice_due === '14'){ echo 'selected';}else{}?>>2 weeks</option>
                                                    <option value="21" <?php  if($invoice_due === '21'){ echo 'selected';}else{}?>>3 weeks</option>
                                                    <option value="28" <?php  if($invoice_due === '28'){ echo 'selected';}else{}?>>1 Month</option>
                                                </select>
                                            </div>    
                                     </div> <!-- end col -->
 
                            </div> <!-- end card-box -->
                            
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="sel_barcode">Is Barcode Scanner Available? </label>
                                        <select id="sel_barcode" name="sel_barcode" class="selectpicker" data-style="btn-outline-dark" required>
                                            <option value="1" <?php  if($barcode === '1'){ echo 'selected';}else{}?>> Yes </option>
                                            <option value="0" <?php  if($barcode === '0'){ echo 'selected';}else{}?>> No </option>
                                          
                                        </select>
                                    </div>   
                                </div> <!-- end col -->

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="sel_printer">Is POS Printer Available? </label>
                                            <select class="selectpicker" data-style="btn-outline-dark" required id="sel_printer" name="sel_printer">
                                                <option value="1" <?php  if($printer === '1'){ echo 'selected';}else{}?>> Yes </option>
                                                <option value="0" <?php  if($printer === '0'){ echo 'selected';}else{}?>> No</option>
                                                
                                            </select>
                                        </div>    
                                    </div> <!-- end col -->
 
                            </div> <!-- end card-box -->

                        <div>
                            <button class="btn btn-pink btn-md mr-2" type="submit"><i class="mdi mdi-content-save"></i> Save Settings</button>
                            <button class="btn btn-danger btn-md" id="cancel"> <i class="mdi mdi-close" ></i> Cancel</button>
                        </div>

                        </form>
                        </div><!-- end col-->
                    </div>
                    <!-- end row -->
                  
    
                    </div> <!-- container -->

                </div> <!-- content -->
                
                <?php require_once 'template/footer.client.php';   ?>
                
                <script src="assets/js/jquery-upload.js"></script>

<script type='text/javascript'>
    $(document).ready(function(){   

        var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }

         $(document).on('click', '#cancel', function(){
            var role_type = '<?php echo $users_role; ?>';
            if(role_type === '1'){
                window.location.href = 'admin.dashboard.php';
            }else if(role_type === '2'){
                window.location.href = 'manager.dashboard.php';
            }else{
                window.location.href = 'index.php';
            }
        });


        var options = { 
            url:'api_calls/settings_api/update_settings.php',   // target element(s) to be updated with server response 
            success:showResponse,  // post-submit callback 
            type:'POST',

        }; 
        
         // bind form using 'ajaxForm' 

        $('#settings-form').submit(function(e){
            e.preventDefault();
            $('#settings-form').ajaxSubmit(options);  
        });

        $('.newbtn').bind("click", function () {
            $('#pic').click();
        });


        $("#pic").on('change', function () {
            readURL(this);
        })       
    });


        
    function readURL(input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#setUrl").attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);

        }
    }



    function showResponse(){  
     Swal.fire(
     'Success!',
     'Settings Information Successfully Saved ',
     'success'
      ).then(function(){window.location.reload();});
    }
               
          
</script>