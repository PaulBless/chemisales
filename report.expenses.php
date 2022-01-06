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

    $get_system_title = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 2") or die(mysqli_error($connect_db));
    $get_title = mysqli_fetch_array($get_system_title);
    $system_title = $get_title['settings_ans'];

    $get_address = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 3") or die(mysqli_error($connect_db));
    $get_address_item = mysqli_fetch_array($get_address);
    $address = $get_address_item['settings_ans'];

    $get_contact = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 4") or die(mysqli_error($connect_db));
    $get_contact_item = mysqli_fetch_array($get_contact);
    $contact = $get_contact_item['settings_ans'];

    $get_email = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 5") or die(mysqli_error($connect_db));
    $get_email_item = mysqli_fetch_array($get_email);
    $email = $get_email_item['settings_ans'];

    $get_quantity_alert = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 6") or die(mysqli_error($connect_db));
    $get_quantity_alert_item = mysqli_fetch_array($get_quantity_alert);
    $quantity_alert = $get_quantity_alert_item['settings_ans'];

    $get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
    $get_currency_item = mysqli_fetch_array($get_currency);
    $currency = $get_currency_item['settings_ans'];

    $get_expire_alert = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 8") or die(mysqli_error($connect_db));
    $get_expire_alert_item = mysqli_fetch_array($get_expire_alert);
    $expire_alert = $get_expire_alert_item['settings_ans'];

    $get_invoice_due = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 9") or die(mysqli_error($connect_db));
    $get_invoice_due_item = mysqli_fetch_array($get_invoice_due);
    $invoice_due = $get_invoice_due_item['settings_ans'];


    $get_profile_pic = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 10") or die(mysqli_error($connect_db));
    $get_profile_pic_item = mysqli_fetch_array($get_profile_pic);
    $profile = $get_profile_pic_item['settings_ans'];

?>


            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page bg-light">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid ">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0 d-nonee" style="font-size: 11px;">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                            <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                            <li class="breadcrumb-item active">Expenses Reports</li>
                                        </ol> 
                                    </div>
                                    <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Reports : <span class="text-danger"> Expenses </span> </h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
        
                        <!-- search report form -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form method="post">
                                            <div class="form-row d-flex justify-content-center align-items-center">
                                            <!-- Start Date -->
                                            <div class="col-auto mr-1">
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text text-dark font-weight-bold">Date From:</div>
                                                        </div>
                                                        <input type="text" class="form-control datepicker" id="start-date" name="start-date" placeholder="Start Date" data-date-autoclose="true" autocomplete="off" required>
                                                    </div>
                                                </div> 
                                                
                                                <!-- End Date  -->
                                                <div class="col-auto mr-1">
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text text-dark font-weight-bold">Date To:</div>
                                                        </div>
                                                        <input type="text" class="form-control datepicker" id="end-date" name="end-date" placeholder="End Date" data-date-autoclose="true" autocomplete="off" required="">
                                                    </div>
                                                </div>

                                                
                                                <div class="col-auto">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mb-0" name="btn_fetch_report" onclick="return checkDate();">Search</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                  
    
    <?php if(isset($_POST['btn_fetch_report']) && isset($_POST['start-date']) && isset($_POST['end-date'])){

    $get_from = $_POST['start-date'];
    $get_to = $_POST['end-date'];
    $yesterday = date('Y-m-d', strtotime($get_from . " - 1 day"));
    $tommorrow = date('Y-m-d', strtotime($get_to . " +1 day"));

    //old format
    // $start_date =  date('Y-m-d h:i',strtotime($yesterday));
    // $end_date = date('Y-m-d h:i',strtotime($tommorrow));

    //new format
    $start_date =  date('Y-m-d h:i',strtotime($get_from));
    $end_date = date('Y-m-d h:i',strtotime($get_to));

    
    ?>
                        <div class="row">
                            <div class="col-12">
                                 <div class="card-box" >
                                    <button type="submit" class="btn btn-info float-right print"> <i class="mdi mdi-printer"></i> Print</button>

                                    <h4 class="header-title mb-4 text-dark">Purchases Report From :  <span class="text-secondary"><?php echo date('d M, Y',strtotime($get_from)).' to '.date('d M, Y',strtotime($get_to)) ?></span></h4>
                                    

                                    <table class="table table-sm table-bordered table-hover m-0 table-centered nowrap w-100 main-table" id="tickets-table">
                                        <thead>
                                        <tr>
                                            <th>Purchase ID</th>
                                            <th>Purchase Details</th>
                                            <th>Purchase Amount</th>
                                            <th>Created By</th>
                                            <th>Date Purchased</th>
                                        </tr>
                                        </thead>

        
                                        <tbody>
        <?php

        $current_day = date('Y-m-d h:i');
        $total = 0;
        
        $get_each_purchase = mysqli_query($connect_db,"SELECT * from `tbl_purchases` WHERE `purchase_date` >= '$start_date' AND purchase_date  <= '$end_date'")or die(mysqli_error($connect_db));
        // $get_each_purchase = mysqli_query($connect_db,"SELECT * from `tbl_purchases` WHERE `purchase_date` BETWEEN '$start_date' AND '$end_date'")or die(mysqli_error($connect_db));
        while($each_purchase = mysqli_fetch_array($get_each_purchase)){
            $creator = $each_purchase['purchase_created_by'];
            $purchase_name = $each_purchase['purchase_id'];
            $purchase_details = $each_purchase['purchase_details'];
            $purchase_amount = $each_purchase['purchase_amount'];
            $purchase_datetime = date('d-M-Y h:i a',strtotime($each_purchase['purchase_date']));
            // $total += $each_purchase['purchase_amount']; 

            //get purchaser name
            $sql = mysqli_query($connect_db,"SELECT * FROM `tbl_users` WHERE`uid`='$creator' LIMIT 1")or die(mysqli_error($connect_db));
            $fetch_me = mysqli_fetch_array($sql);
            $purchaser_name = $fetch_me['user_firstname'].' '.$fetch_me['user_lastname'];

                ?>

                <tr>
                <td><?php echo $purchase_name;  ?></td>
                <td><?php echo $purchase_details;  ?></td>
                <td><?php echo $currency." ".$purchase_amount;  ?></td>
                <td><?php echo $purchaser_name;  ?></td>
                <td><?php echo $purchase_datetime;  ?></td>
                </tr>
            
                <?php }
            } ?>

          <input readonly value="<?php echo date('d-M-Y', strtotime($get_from));  ?>" type="hidden" id="starts_from">
                <input readonly value="<?php echo date('d-M-Y', strtotime($get_to));  ?>" type="hidden" id="ends_at">                              
                                        </tbody>
                                        <!-- <tfoot>

                                        <tr style="background-color: #728090">
                                            <td colspan="6"><h4>Total Amount</h4></td>
                                            <td colspan="1"><h3><span class="badge btn-secondary"><?php  echo $currency ?></span></h3></td>
                                        </tr>

                                        </tfoot>  -->
                                    </table>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->   
                        
                    
                    <?php  ?>

                     <div class="details" style="display:none;">
                        <div style="text-align: center;">
                        <h3> Pharmacy Management & Billing System</h3>
                        <p><b> Expenses Reports from <?php echo date('d-M-Y', strtotime($get_from)); ?> - <?php echo date('d-M-Y', strtotime($get_to)) ?></b></p>
                        </div>
                    </div>


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


        $(".datepicker").datepicker({
            orientation: 'bottom',
            autoclose: true,
        });
        
        $(document).on('click', '.print', function (e) {
            var ns = $('.details').clone()
            var content = $('#tickets-table').clone()
            ns.append(content)

            var new_window = window.open('', '', 'height=600, width=900')
            new_window.document.write(ns.html())
            new_window.document.close()
            new_window.print()
            setTimeout(function(){
            new_window.close()
            }, 500)
            
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

    function checkDate(){
        var start_date = $('#start-date').val();
        var end_date = $('#end-date').val();
        if(start_date == '' || end_date == ''){
            swal.fire('Ooops','Specify Start and End Date','error');
            return false;
        }else if(start_date === end_date){
            swal.fire('Error', 'Start Date and End Date cannot be the same, Please enter different values', 'warning');
            return false;
        }

    }

    function showResponse(){  
     Swal.fire(
     'Success!',
     'Settings Updated Successfully',
     'success'
      )
    }
               
          
</script>