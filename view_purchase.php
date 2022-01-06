<?php  require_once 'db/db.php'; ?>

<?php
 if (isset($_GET['i'])) {
     $purchases_id = $_GET['i'];

     $get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
    $get_currency_item = mysqli_fetch_array($get_currency);
    $currency = $get_currency_item['settings_ans'];

 } else {
     echo "<script>window.location.href='purchases.php'</script>";
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
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                      
                                    </div>
                                          <h4 class="page-title font-weight-bold" style="letter-spacing: 1px;">View Purchase</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                            <?php

                            ?>
                                 <div class="card-box" >
                                <form id="products_form" method="post">
                                    <table class="table table-hover  m-0 table-centered dt-responsive nowrap w-100 rowfy">
                                        <thead class="bg-info text-dark">
                                        <tr>
                                            <th width="12%">ID</th>
                                            <th width="14%">Supplier</th>
                                            <th width="12%">Product</th>
                                            <th width="15%">Quantiy</th>
                                            <th width="15%">Paid</th>
  
                                        </tr>
                                        </thead>
                                        
                                        <tbody id="table_body">
                                            <?php
                                            $quantity_counter = 0;
                                            $amount_counter = 0;

                                            $get_purchases = mysqli_query($connect_db,"SELECT * from tbl_purchase join tbl_products on tbl_purchase.purchase_item_id = tbl_products.tbl_products_id join tbl_suppliers on tbl_purchase.purchase_supplier = tbl_suppliers.supplier_id WHERE `purchase_related_id`= '$purchases_id'");
                                            while ($each_purchase = mysqli_fetch_array($get_purchases)) {
                                                $get_id = $each_purchase['purchase_related_id'];
                                                $get_product = $each_purchase['product_name'];
                                                $get_quantity = $each_purchase['purchase_quantity'];
                                                $get_supplier = $each_purchase['supplier_name']; 
                                                $get_paid = $each_purchase['amount_paid']; 
                                                
                                                $quantity_counter += $get_quantity;
                                                $amount_counter += $get_paid;
                                                ?>

                                                <tr>
                                                <td><?php  echo $get_id; ?></td>
                                                <td><?php  echo $get_supplier; ?></td>
                                                <td><?php  echo $get_product; ?></td>
                                                <td><?php  echo $get_quantity; ?></td>
                                                <td><?php  echo $get_paid; ?></td>
                                                </tr>
                                                
                                           <?php }
                                            
                                            ?>
                                       
                                        
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                          <td colspan="4" class="text-right"><h4>Total Quantity: <span class="font-weight-bold doubleUnderline"><?php echo $quantity_counter;  ?></span></h4></td>
                                        
                                          <td colspan="2" class="text-center"><h4>Total Amount: <?php echo $currency;  ?> <span class="font-weight-bold doubleUnderline"><?php echo number_format((float)$amount_counter, 2, '.', '');  ?> </span></h4> </td>
                                      
                                          </tr>
                                        </tfoot>
                                       
                                    </table>
                                    </form>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->    
                        
                    </div> <!-- container -->

                </div> <!-- content -->



                <?php require_once 'modals/user_record_modal.php';   ?>
                <?php require_once 'footer/admin-footer.php';   ?>

                <script type='text/javascript'>

            $(document).ready(function(e){
               
               $(".datepicker").datepicker({ orientation: 'bottom'});

                $(document).on('click','#add',function(){

                    var html='';
                    html+='<tr>';
                    html+='<td><select class="form-control products" name="name[]"><?php   $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_products`"); while ($each_product = mysqli_fetch_array($get_products)) {  ?><option value="<?php  echo $each_product['tbl_products_id'] ?>"><?php echo $each_product['product_name']  ?></option><?php } ?></select></td>';
                    html+='<td> <select class="form-control products" name="supplier[]"><?php   $get_suppliers = mysqli_query($connect_db,"SELECT * FROM `tbl_suppliers`");while ($each_supplier = mysqli_fetch_array($get_suppliers)) {  ?><option value="<?php  echo $each_supplier['supplier_id'] ?>"><?php echo $each_supplier['supplier_name']  ?></option> <?php } ?>select></td>';
                    html+='<td><input type="text" autocomplete="off" class="form-control products" name="quantity[]" ></td>';
                    html+='<td><input type="text" autocomplete="off" class="form-control products" name="paid[]" ></td>';
                    html+='<td><input type="text" autocomplete="off" class="form-control products datepicker" data-date-autoclose="true" name="expiry[]"></td>';
                    html+='<td><button type="button" name="remove" class="btn btn-danger btn_remove">X</button></td>';
                    html+='</tr>';

                    $('#table_body').append(html);
                    $('.datepicker').removeClass('hasDatepicker').datepicker({orientation:'bottom'})
                });
                
                $(document).on('click', '.btn_remove', function(){
                   $(this).closest('tr').remove();
                });



            

            $(document).on("submit","#products_form",function(e){
                e.preventDefault();
                    var formdata = $(this).serialize();

                    $.ajax({
			   		url: 'api_calls/purchases_api/add-purchase.php',
			    	type: 'POST',
			       	data: formdata,
			       	success:function(res){
                        if(res === "success"){
                        Swal.fire(
                        'Good job!',
                        'Purchase Recorded Successfully',
                        'success'
                        ).then(function(){window.location.href='add_purchase.php'});

                        }else{
                        Swal.fire(
                        'Ooops',
                        'Something Went Wrong',
                        'error'
                        ).then(function(){window.location.href='add_purchase.php'});
                        }
                       },
                    error:function(){}
			     })

                    // console.log(formdata);
                   

            })



        })

    </script>