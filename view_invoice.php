<?php  require_once 'db/db.php';

$get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
$get_currency_item = mysqli_fetch_array($get_currency);
$currency = $get_currency_item['settings_ans'];
?>

<?php

if (isset($_GET['view'])) {
    $selected_invoice = $_GET['view'];

    $getInvoiceInfo = mysqli_query($connect_db,"SELECT * FROM tbl_each_invoice WHERE related_invoice_id = '$selected_invoice' LIMIT 1")or die(mysqli_error($connect_db)); 
        $invoice_info = mysqli_fetch_array($getInvoiceInfo);
        $get_invoice_id = $invoice_info['related_invoice_id'];
        $get_company_name = $invoice_info['company_name'];
        $total_amount = $invoice_info['total_amount'];
        $get_expiry_date = $invoice_info['expiry_date'];
        $get_status = $invoice_info['status'];
        $get_tax_rate = $invoice_info['tax_rate'];
        $get_tax_amount = $invoice_info['tax_amount'];
        $get_discount_rate = $invoice_info['discount_rate'];
        $get_discount_amount = $invoice_info['discount_amount'];
        $get_subtotal = $invoice_info['sub_total'];
        $get_address_info = $invoice_info['company_address'];
        $get_date = date('d-M-Y',strtotime($invoice_info['invoice_timestamp']));


        // System Name
        $get_system_name = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 1") or die(mysqli_error($connect_db));
        $get_name = mysqli_fetch_array($get_system_name);
        $system_name = $get_name['settings_ans'];

        // System Address
        $get_system_address = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 3") or die(mysqli_error($connect_db));
        $get_address = mysqli_fetch_array($get_system_address);
        $system_address = $get_address['settings_ans'];

        // System E-MAIL
        $get_system_email = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 5") or die(mysqli_error($connect_db));
        $get_email = mysqli_fetch_array($get_system_email);
        $system_email = $get_email['settings_ans'];

        // System Contact
        $get_system_contact = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 4") or die(mysqli_error($connect_db));
        $get_contact = mysqli_fetch_array($get_system_contact);
        $system_contact = $get_contact['settings_ans'];
       
        // Number Of Days
        $get_number_of_days = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 9") or die(mysqli_error($connect_db));
        $get_days = mysqli_fetch_array($get_number_of_days);
        $invoice_days = $get_days['settings_ans'];
        
        // Set Logo
        $get_logo_item = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 10") or die(mysqli_error($connect_db));
        $get_logo = mysqli_fetch_array($get_logo_item);
        $logo = $get_logo['settings_ans'];



}else{
    echo "<script>window.location.href='manage_invoice.php'</script>";
}

?>

<?php  require_once 'header/admin-header.php';  ?>

<?php  require_once 'sidebar/admin-sidebar.php';  ?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                    
                        <div class="row">
                            <div class="col-12">
                                 <div class="card-box" >
                                    <!-- Logo & title -->
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <img src="assets/images/<?php echo $logo;  ?>" alt="" height="70px" width="70px">
                                        </div>
                                        <div class="float-right">
                                            <h4 class="m-0 d-print-none">Invoice</h4>
                                        </div>
                                    </div>
        
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <p><b>Hello, <?php echo $get_company_name;  ?></b></p>
                                                <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                                                    promises to provide high quality products for you as well as outstanding
                                                    customer service for every transaction. </p>
                                            </div>
        
                                        </div><!-- end col -->
                                        <div class="col-md-4 offset-md-2">
                                            <div class="mt-3 float-md-right">
                                                <p><strong>Order Date : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $get_date;   ?></span></p>
                                                <p><strong>Order Status : </strong> <span class="float-right"><span class="badge badge-success"><?php  echo $get_status   ?></span></span></p>
                                                <p><strong>Order No. : </strong> <span class="float-right"><?php echo $get_invoice_id  ?> </span></p>
                                            </div>
                                        </div><!-- end col -->
                                    </div>
                                    <!-- end row -->
        
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <h6>Billing Address</h6>
                                            <address>
                                            <?php echo $system_name; ?><br>	
                                            <?php echo $system_address; ?><br>	
                                            <?php echo $system_email; ?><br>
                                            <?php echo $system_contact; ?><br>	
                                            </address>
                                        </div> <!-- end col -->
        
                                        <div class="col-md-6">
                                            <div class="text-md-right">
                                                <h6>Shipping Address</h6>
                                                <address>
                                                <?php echo $get_company_name; ?><br>	
                                                <?php echo $get_address_info; ?><br>	
                                               	
                                                </address>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> 
                                    <!-- end row -->

        
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table mt-4 table-centered">
                                                    <thead class="bg-info text-dark">
                                                    <tr><th>#</th>
                                                        <th>Item Name</th>
                                                        <th style="width: 10%">Price</th>
                                                        <th style="width: 10%">Quantity</th>
                                                        <th style="width: 10%" class="text-right">Total</th>
                                                    </tr></thead>
                                                    <tbody>
                                                    <?php   
                                        
                                        $getInvoiceInfo = mysqli_query($connect_db,"SELECT *
                                        FROM tbl_invoice
                                        JOIN tbl_products ON tbl_invoice.product_name = tbl_products.tbl_products_id WHERE tbl_invoice.invoice_number = '$selected_invoice'")or die(mysqli_error($connect_db));
                                        $counter = 1;
                                        while($invoice_info = mysqli_fetch_array($getInvoiceInfo)){  
                                            
                                            $get_invoice_id = $invoice_info['invoice_number'];
                                            $get_product_name = $invoice_info['product_name'];
                                            $get_total_amount = $invoice_info['product_total'];
                                            $get_expiry_date = $invoice_info['expiry_date'];
                                            $get_quantity = $invoice_info['product_quantity'];
                                            $get_price = $invoice_info['selling_price'];
                                           
?>
                                            <tr>
                                            <td>
                                                <b><?php echo $counter;   ?></b>
                                            </td>
                                            <td>
                                                <b><?php echo $get_product_name;   ?></b>
                                            </td>
                                            <td>
                                                <b><?php echo number_format((float)$get_price,2,'.','') ;   ?></b>
                                               
                                            </td>
                                            <td>
                                            <?php echo $get_quantity;   ?>
                                            </td>
                                            <td>
                                            <b><?php echo number_format((float)$get_total_amount,2,'.','') ;   ?></b>
                                            </td>

                                        </tr>
                                                   

                                      <?php  $counter++; }
                                        ?>

                                                   
        
                                                    </tbody>
                                                </table>
                                            </div> <!-- end table-responsive -->
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->
        
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="clearfix pt-5">
                                                <h6 class="text-muted">Notes:</h6>
        
                                                <small class="text-muted">
                                                    All accounts are to be paid within <?php echo $invoice_days; ?> days from receipt of
                                                    invoice. To be paid by cheque or credit card or direct payment
                                                    online. If account is not paid within <?php echo $invoice_days; ?> days the credits details
                                                    supplied as confirmation of work undertaken will be charged the
                                                    agreed quoted fee noted above.
                                                </small>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-sm-6">
                                            <div class="float-right">
                                                <p><b>Sub-total:</b> <span class="float-right"><?php echo $currency." ".$get_subtotal;  ?></span></p>
                                                <p><b>Tax (<?php echo $get_tax_rate  ?>%):</b> <span class="float-right"><?php  echo $currency." ".$get_tax_amount; ?></span></p>
                                                <p><b>Discount (<?php echo $get_discount_rate  ?>%):</b> <span class="float-right"> &nbsp;&nbsp;&nbsp; <?php  echo $currency." ".$get_discount_amount; ?></span></p>
                                                <h3><?php  echo $currency." ".$total_amount ?></h3>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->
        
                                    <div class="mt-4 mb-1">
                                        <div class="text-right d-print-none">
                                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer mr-1"></i> Print</a>
                                        </div>
                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->     
                        
                    </div> <!-- container -->

                </div> <!-- content -->
                
                <?php require_once 'modals/user_record_modal.php';   ?>
                <?php require_once 'footer/admin-footer.php';   ?>

                <script type='text/javascript'>
                $(document).ready(function(){
                readProducts(); /* it will load products when document loads */  
                $(".datepicker").datepicker({ orientation: 'bottom',autoclose: true,});
                $('select').niceSelect();
            
                    $('#edit_new_product').submit(function(e){
                    e.preventDefault();
                    var formdata = $(this).serialize();

                    $.ajax({
                        url:'api_calls/products_api/edit-load-product.php',
                        type: 'POST',
			       	    data: formdata,
                        success:function(res){
                        
                        if(res === "success"){
                        Swal.fire(
                        'Good job!',
                        'All Products Loaded Successfully',
                        'success'
                        ).then(function(){readProducts()});

                        }else{
                            Swal.fire(
                        'Ooops',
                        'Something Went Wrong',
                        'error'
                        ).then(function(){readProducts()});
                        }

                           

                        $('#load-modal').modal('hide');
                        $('#product_id').val('');
                        $('#new_quantity').val('');
                        $('#new_expiry').val('');
                        $('.datepicker').removeClass('hasDatepicker').datepicker({orientation:'bottom',autoclose: true,})
                        
                        },
                        error:function(res){
                            console.log(res);
                        }

                    });

                })



                $(document).on('click','.load-product-button',function(e) {
                    var productId = $(this).data('id');
                    $.ajax({
                        url:'api_calls/products_api/product-details.php',
                        type: 'POST',
			       	    data: 'productId='+productId,
                        dataType: 'json' ,
                        success:function(res){
                            $('#product_id').val(res.product_id);
                            $('#old_quantity').val(res.product_quantity);
                            
                            $('#load-modal').modal('show');
                            $('.datepicker').removeClass('hasDatepicker').datepicker({orientation:'bottom',autoclose: true,})
                        },
                        error:function(res){
                            console.log(res);
                        }    
                    });
                });
   
     
            });
            
            function readProducts(){
                $('#fetch-products').load('api_calls/invoice_api/fetch-invoice.php');
            }


    </script>