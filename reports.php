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
                                            <li class="breadcrumb-item active">Sales Reports</li>
                                        </ol> 
                                    </div>
                                    <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Reports : <span class="text-danger"> Sales </span> </h4>
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
                                                        <input type="text" class="form-control datepicker" id="start-date" name="start-date" placeholder="Start Date">
                                                    </div>
                                                </div> 
                                                
                                                <!-- End Date  -->
                                                <div class="col-auto mr-1">
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text text-dark font-weight-bold">Date To:</div>
                                                        </div>
                                                        <input type="text" name="end-date" class="form-control datepicker" id="end-date" placeholder="End Date">
                                                    </div>
                                                </div>

                                                
                                                <div class="col-auto">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mb-0"> Submit </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                  
                        <!-- reports view details   -->
                        
                    <?php if(isset($_POST['btn_fetch_report'])){
                        
                        $get_from = $_POST['start-date'];
                        $get_to = $_POST['end-date'];
                        $yesterday = date('Y-m-d', strtotime($get_from . " - 1 day"));
                        $tommorrow = date('Y-m-d', strtotime($get_to . " +1 day"));

                        $start_date =  date('Y-m-d h:i a',strtotime($yesterday));
                        $end_date = date('Y-m-d h:i a',strtotime($tommorrow));
                        
                        ?>
                        <div class="row">
                            <div class="col-12">
                                 <div class="card-box" style="border-top: 3px solid #14324d;">
                                    <h4 class="header-title mb-4 text-dark">Sales Report From : <span class="text-danger"> <?php echo date('d-M-Y',strtotime($get_from)).' to '.date('d-M-Y',strtotime($get_to)) ?></span></h4>
                                    <table class="table table-hover  m-0 table-centered dt-responsive nowrap w-100 main-table">
                                        <thead class="bg-dark text-white">
                                        <tr>
                                            <th>Drug Name</th>                                        
                                            <th>Unit</th>                                        
                                            <th>Price</th>                                        
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Served By</th>
                                            <th>Time</th>
                                        </tr>
                                        </thead>

        
                                        <tbody>
        <?php

        $current_day = date('Y-m-d h:i');
        $subtotal_counter = 0;
        $tax_counter = 0;
        $discount_counter = 0;
        $cost_price_counter = 0;
        $selling_price_counter = 0;

        // Get Expense number 

        $get_expense_today = mysqli_query($connectionString,"SELECT * FROM `tbl_expenses` WHERE expense_date > '$start_date' AND expense_date < '$end_date'")or die(mysqli_error($connectionString));
        $expense_counter = 0;

        while ($get_expense = mysqli_fetch_array($get_expense_today)) {
            $expense_total = $get_expense['expense_amount'];
            $expense_counter+= $expense_total;
        }

        $get_each_sale = mysqli_query($connectionString,"SELECT * FROM `tbl_each_sales` WHERE `sales_timestamp` > '$start_date' AND sales_timestamp  < '$end_date'")or die(mysqli_error($connectionString));
        while($eachSale = mysqli_fetch_array($get_each_sale)){
            $get_sales_Id = $eachSale['sales_id_number'];
            $tax_counter += $eachSale['tax_amount'];
            $discount_counter += $eachSale['discount_amount'];
            $subtotal_counter += $eachSale['sales_subtotal'];

            $served_by = $eachSale['sales_seller'];
            $served_time = strtotime($eachSale['sales_timestamp']);

            $time = date('d-M-Y H:i:s',$served_time);

            $fetch_sales = mysqli_query($connectionString,"SELECT * FROM `tbl_sales_table` WHERE `sales_id_number` = '$get_sales_Id'")or die(mysqli_error($connectionString));
            while ($each_single_sale = mysqli_fetch_array($fetch_sales)) { 

            $get_product_name = $each_single_sale['product_name'];
            $get_product_price = $each_single_sale['product_price'];
            $get_product_total = $each_single_sale['product_total'];
            $get_product_quantity = $each_single_sale['product_quantity'];
            $get_product_type = $each_single_sale['quantity_type'];

                
            

            $get_product_details = mysqli_query($connectionString,"SELECT * FROM `tbl_products` WHERE `tbl_products_id` = '$get_product_name'")or die(mysqli_error($connectionString));
                $get_product_details = mysqli_fetch_array($get_product_details);

                if($get_product_type  == 1){
                    // meaning item sold pcs
                    $product_name = $get_product_details['product_name'];
                $product_cost_price = $get_product_details['cost_price_pcs'];
                $item_unit = 'PCS';
                }else{
                    // meaning item sold is box
                     $product_name = $get_product_details['product_name'];
                $product_cost_price = $get_product_details['cost_price_box'];
                $item_unit = "BOX";
                }

               

                $finding_cost_price = $product_cost_price*$get_product_quantity;
                $finding_selling_price = $get_product_price*$get_product_quantity;

                $cost_price_counter+= $finding_cost_price;
                $selling_price_counter += $finding_selling_price;

                if($served_by === '0'){
                    $get_by = "Admin";
                }else{
                    $get_from_pharmacists_table = mysqli_query($connectionString,"SELECT * FROM pharmacists_table WHERE `pharmacists_id` = $served_by LIMIT 1")or die(mysqli_error($connectionString));
                    $get_name = mysqli_fetch_array($get_from_pharmacists_table);

                    $name = $get_name['pharmacists_firstname'].' '.$get_name['pharmacists_lastname'];
                    $get_by = $name;
                }

                ?>
                
                <tr>
                <td><?php echo $product_name;  ?></td>
                <td><?php echo $item_unit;  ?></td>
                <td><?php echo $get_product_price;  ?></td>
                <td><?php echo $get_product_quantity;  ?></td>
                <td><?php echo $get_product_total;  ?></td>
                <td><?php echo $get_by;  ?></td>
                <td><?php echo $time;  ?></td>
                </tr>
            
<?php }} ?>

<input readonly value="<?php echo date('d-M-Y', strtotime($get_from));  ?>" type="hidden" id="starts_from">
                <input readonly value="<?php echo date('d-M-Y', strtotime($get_to));  ?>" type="hidden" id="ends_at">
                                        
                                        </tbody>
                                        <tfoot>
                                        <tr style="background-color: #ace2ac !important;">
                                            <td colspan="6"><h4>Sub Total</h4></td>
                                            <td colspan="1"><h3><span class="badge btn-info"><?php echo $currency." ".$subtotal_counter; ?></span></h3></td>
                                        </tr>
                                        
                                        <tr style="background-color: #99bef5">
                                            <td colspan="6"><h4>Total Discount</h4></td>
                                            <td colspan="1"><h3><span class="badge btn-primary"><?php  echo $currency." ".$discount_counter ?></span></h3></td>
                                        </tr>

                                        <tr style="background-color: #728090">
                                            <td colspan="6"><h4>Total Tax</h4></td>
                                            <td colspan="1"><h3><span class="badge btn-secondary"><?php  echo $currency." ".$tax_counter ?></span></h3></td>
                                        </tr>

                                        <tr style="background-color: #e6baad">
                                            <td colspan="6"><h4>Total Expenditure</h4></td>
                                            <td colspan="1"><h3><span class="badge btn-danger"><?php  echo $currency." ".$expense_counter ?></span></h3></td>
                                        </tr>


                                        <tr style="background-color: #728090">
                                            <td colspan="6"><h4>Overall Cost Price</h4></td>
                                            <td colspan="1"><h3><span class="badge btn-secondary"><?php  echo $currency." ".$cost_price_counter ?></span></h3></td>
                                        </tr>

                                        <tr style="background-color: #e6baad">
                                            <td colspan="6"><h4>Gross Sales (<em>Minus overall discount and expenditure</em>)</h4></td>
                                            <td colspan="1"><h3><span class="badge btn-danger"><?php $gross_sales = ($subtotal_counter+$tax_counter)-($discount_counter+$expense_counter); echo $currency." ".$gross_sales; ?></span></h3></td>
                                        </tr>

                                        <tr style="background-color: #ace2ac !important;">
                                            <td colspan="6"><h3>Profit</h3></td>
                                            <td colspan="1"><h3><span class="badge btn-info"><?php $profit = ($gross_sales) - ($cost_price_counter); echo $currency." ".$profit; ?></span></h3></td>
                                        </tr>


                                        </tfoot>
                                    </table>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->   
                        
                    
                    <?php  }else{}; ?>
                        <!-- report view end  -->


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
     'Settings Updated Successfully',
     'success'
      )
    }
               
          
</script>