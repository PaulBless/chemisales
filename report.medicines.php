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


## Medicines Array
$medicines_array = [];
$get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines`")or die(mysqli_error($connect_db));
                                        
while ($each_product = mysqli_fetch_array($get_products)) { 
 $product_id = $each_product['mid'];
 $product_name = $each_product['medicine_name'];
 
 $medicines_array += [$product_id=>$product_name]; 

}


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

<style>
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    height: 36px !important;
    padding-top: 5px !important;
}
</style>

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
                                            <li class="breadcrumb-item active">Medicines Reports</li>
                                        </ol> 
                          
                                    </div>
                                    <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Report : <span class="text-danger"> Medicines </span> </h4>
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
                                            
                                                <!-- Select Medicine -->
                                                <!-- <div class="col-auto mr-1"> -->
                                                <div class="col-4 mr-1">
                                                    <div class="input-group mb-0">
                                                        <select class="form-control select-custom" name="selected_medicine" id="medicine" required>
                                                            <option disabled selected value="">Select Medicine</option>
                                                            <?php foreach ($medicines_array as $key => $value) {  ?>
                                                            <option value="<?php echo $key; ?>"><?php echo $value;  ?></option>
                                                            <?php  }  ?>
                                                        </select>
                                                    </div>
                                                </div>  
                                                
                                                <!-- Start Date -->
                                                <div class="col-auto mr-1">
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text text-dark font-weight-bold d-none">Date From:</div>
                                                        </div>
                                                        <input type="text" class="form-control datepicker" id="start-date" name="start-date" placeholder="Start Date" data-date-autoclose="true" autocomplete="off" required="">
                                                    </div>
                                                </div> 
                                                
                                                <!-- End Date  -->
                                                <div class="col-auto mr-1">
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text text-dark font-weight-bold d-none">Date To:</div>
                                                        </div>
                                                        <input type="text" class="form-control datepicker" id="end-date" placeholder="End Date" data-date-autoclose="true" autocomplete="off" required="" name="end-date">
                                                    </div>
                                                </div>

                                                
                                                <div class="col-auto">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mb-0" onclick="return checkDate();" name="btn-fetch-report"> Search </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                  
                        
                        <!-- reports view details   -->
                        
                    <?php if(isset($_POST['btn-fetch-report']) && isset($_POST['start-date']) && isset($_POST['end-date'])){

                        $selected_medicine = $_POST['selected_medicine'];
                        $get_from = $_POST['start-date'];
                        $get_to = $_POST['end-date'];
                        $yesterday = date('Y-m-d', strtotime($get_from . " - 1 day"));
                        $tommorrow = date('Y-m-d', strtotime($get_to . " +1 day"));

                        // old format
                        // $start_date =  date('Y-m-d h:i',strtotime($yesterday));
                        // $end_date = date('Y-m-d h:i',strtotime($tommorrow));
                        
                        // new search format
                        $start_date =  date('Y-m-d h:i',strtotime($get_from));
                        $end_date = date('Y-m-d h:i',strtotime($get_to));
                        
                        ?>
                        <div class="row">
                            <div class="col-12">
                                 <div class="card-box" style="border-top: 5px solid #145388;">

                                 <button type="submit" class="btn btn-info float-right print"> <i class="mdi mdi-printer"></i> Print</button>
                                 
                                    <h4 class="header-title mb-4 text-dark text-center">Medicine Sales Report From : <span class="text-secondary"> <?php echo date('d-M-Y',strtotime($get_from)).' to '.date('d-M-Y',strtotime($get_to)) ?></span></h4>
                                    
                                    <table class="table table-sm table-bordered table-hover m-0 table-centered nowrap w-100 main-table" id="tickets-table">

                                        <thead>
                                        <tr>
                                            <th>Drug Name</th>                                        
                                            <th>Unit</th>                                        
                                            <th>Price</th>                                        
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Served By</th>
                                            <th>Datetime</th>
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
        $get_expense_today = mysqli_query($connect_db,"SELECT * FROM `tbl_expenses` WHERE expense_date > '$start_date' AND expense_date< '$end_date'")or die(mysqli_error($connect_db));
        $expense_counter = 0;

        while ($get_expense = mysqli_fetch_array($get_expense_today)) {
            $expense_total = $get_expense['expense_amount'];
            $expense_counter+= $expense_total;
        }

       
        // $get_each_sale = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` >= '$start_date' AND `sales_datetime`  <= '$end_date' ORDER BY `sales_datetime` ASC")or die(mysqli_error($connect_db));
        $get_each_sale = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` BETWEEN '$start_date' AND '$end_date' ORDER BY `sales_datetime` ASC")or die(mysqli_error($connect_db));
        if(!empty($get_each_sale)) :
        while($eachSale = mysqli_fetch_array($get_each_sale)){
            $get_sales_Id = $eachSale['sales_number'];
            $tax_counter += $eachSale['tax_amount'];
            
            $served_by = $eachSale['sales_seller_id'];
            $served_time = strtotime($eachSale['sales_datetime']);
            
            $time = date('d-M-Y H:i:s a',$served_time);
            
            $fetch_sales = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number` = '$get_sales_Id' AND `medicineId` = '$selected_medicine'")or die(mysqli_error($connect_db));
            while ($each_single_sale = mysqli_fetch_array($fetch_sales)) { 
                
                $medicine_id = $each_single_sale['medicineId'];
                $medicine_price = $each_single_sale['medicinePrice'];
                $medicine_total = $each_single_sale['medicineTotal'];
                $medicine_quantity = $each_single_sale['medicineQty'];
                $get_product_type = $each_single_sale['quantity_type'];
                
                $subtotal_counter += $eachSale['sales_subtotal'];   // sales total
            
            // get medicine details
            $get_product_details = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE `mid` = '$medicine_id'")or die(mysqli_error($connect_db));
            $get_product_details = mysqli_fetch_array($get_product_details);

                if($get_product_type  == 1){
                    // meaning item sold pcs
                    $product_name = $get_product_details['medicine_name'];
                    $product_cost_price = $get_product_details['cost_price'];
                    $product_selling_price = $get_product_details['selling_price'];
                    $item_unit = 'Pcs';
                }else{
                    // meaning item sold is box
                     $product_name = $get_product_details['medicine_name'];
                    $product_cost_price = $get_product_details['cost_price'];
                    $product_selling_price = $get_product_details['selling_price'];
                    $item_unit = "Box";
                }

               
                // calculate prices of cost & selling
                $finding_cost_price = $product_cost_price*$medicine_quantity;
                $finding_selling_price = $medicine_price*$medicine_quantity;

                $cost_price_counter+= $finding_cost_price;
                $selling_price_counter += $finding_selling_price;

                // get name of sales seller
                if(!empty($served_by)){              
                    $get_from_users_table = mysqli_query($connect_db,"SELECT * FROM `tbl_users` WHERE `uid` = $served_by LIMIT 1")or die(mysqli_error($connect_db));
                    $get_name = mysqli_fetch_array($get_from_users_table);

                    $name = $get_name['user_firstname'].' '.$get_name['user_lastname'];
                    $get_by = $name;
                }

                ?>
                
                <tr>
                <td><?php echo $product_name;  ?></td>
                <td><?php echo $item_unit;  ?></td>
                <td><?php echo $currency." ".$medicine_price;  ?></td>
                <td><?php echo $medicine_quantity;  ?></td>
                <td><?php echo $currency." ".$medicine_total;  ?></td>
                <td><?php echo $get_by;  ?></td>
                <td><?php echo $time;  ?></td>
                </tr>
            
    <?php } } endif; ?>

        <input readonly value="<?php echo date('d-M-Y', strtotime($get_from));  ?>" type="hidden" id="starts_from"><input readonly value="<?php echo date('d-M-Y', strtotime($get_to));  ?>" type="hidden" id="ends_at">
                                        
                                        </tbody>
                                        <tfoot class="small">
                                        <tr style="background-colorr: #ace2ac !important;">
                                            <td colspan="6"><h4>Total Amount</h4></td>
                                            <td colspan="1"><h3><span class="badge btn-info"><?php echo $currency." ".$subtotal_counter; ?></span></h3></td>
                                        </tr>
                                        

                                        <tr style="background-colorr: #728090">
                                            <td colspan="6"><h4>Total Tax Amount</h4></td>
                                            <td colspan="1"><h3><span class="badge btn-secondary"><?php  echo $currency." ".$tax_counter.".00"; ?></span></h3></td>
                                        </tr>


                                        <tr style="background-colorr: #e6baad; display: nonee;">
                                            <td colspan="6"><h4>Overall Cost Price</h4></td>
                                            <td colspan="1"><h3><span class="badge btn-danger"><?php  echo $currency." ".$cost_price_counter; ?></span></h3></td>
                                        </tr>

                                        <tr style="background-colorr: #99bef5 !important;">
                                            <td colspan="6"><h3>Profit</h3></td>
                                            <td colspan="1"><h3><span class="badge btn-primary"><?php $profit = ($selling_price_counter) - ($cost_price_counter); echo $currency." ".$profit; ?></span></h3></td>
                                        </tr>


                                        </tfoot>
                                    </table>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->   
                        
                    
                    <?php  }else{}; ?>
                    <!-- report view end  -->

     <div class="details" style="display:none;">
        <div style="text-align: center;">
          <h3> Pharmacy Management & Billing System</h3>
          <p><b> Medicine Sales Reports from <?php echo date('d-M-Y', strtotime($get_from)); ?> - <?php echo date('d-M-Y', strtotime($get_to)) ?></b></p>
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

        
        $('.select-custom').select2();

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
    
    });


    function checkValidity(){
        var start_date = $('#start-date').val();
        var end_date = $('#end-date').val();
        var medicine = $('#medicine').val();
        if(medicine == '' || start_date == '' || end_date == ''){
            swal.fire('Error', 'Kindly choose medicine, and Specify Start and End Date', 'warning');
            return false;
        }

    } 
    
    function checkDate(){
        var start_date = $('#start-date').val();
        var end_date = $('#end-date').val();
        if(start_date === end_date){
            swal.fire('Error', 'Start Date and End Date cannot be the same, Please enter different values', 'warning');
            return false;
        }

    }
   
               
          
</script>