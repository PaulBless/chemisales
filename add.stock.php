<?php 
   
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

    
    //get medicine
    $set_medicine="";
    if(isset($_GET['medicine_id']))
    $set_medicine=($_GET['medicine_id']);

     $stmt = mysqli_query($connect_db, "SELECT * FROM `tbl_medicines` WHERE mid='$set_medicine'");
    $record = mysqli_fetch_array($stmt);
    $get_selling_price = $record['selling_price'];
    $get_cost_price = $record['cost_price'];
    $get_name_medicine = strtolower($record['medicine_name']);
?>

<?php

## Supplier List Array
    $suppliers_array = [];
    $get_suppliers = mysqli_query($connect_db,"SELECT * FROM `tbl_suppliers`")or die(mysqli_error($connect_db));
                                            
    while ($each_supplier = mysqli_fetch_array($get_suppliers)) { 
    $supplier_id = $each_supplier['supplier_id'];
    $supplier_name = $each_supplier['supplier_name'];
    
    $suppliers_array += [$supplier_id=>$supplier_name]; 
    }


## Get Currency Symbol    
    $get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
    $get_currency_item = mysqli_fetch_array($get_currency);
    $currency = $get_currency_item['settings_ans'];


// Generate Random Stock Id
    $pre = "S/";
    $st_value = $pre. mt_rand(10000, 99999);

// Generate Random Purchase Id
    $afx = "P/";
    $pc_value = $afx. mt_rand(100000, 999999);

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
                         
                         <button type="button" id="go-back" class="btn btn-warning btn-sm text-dark float-right ml-4"><i class="mdi mdi-arrow-left"></i> Go Back </button>

                            <ol class="breadcrumb m-0" style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item active">Add Stock</li>
                            </ol>

                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Add Stock for - <span class="text-capitalize text-pink"><?php echo $get_name_medicine ?> </span> </h4>
                            
                    </div>
                </div>
            </div>
            <!-- end page title -->



            <!-- Add Medicine -->
            <div class="row">
                <div class="col-md-12">
                     <div class="card-box">
                        <form method="post" id="add-stock" class="needs-validation was-validatedd" novalidate >
                            <input type="hidden" value="<?php echo $pc_value?>" name="purchase-id">
                            <input type="hidden" value="<?php echo $st_value?>" name="stock-id">

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Medicine Name -->
                                    <div class="form-group mb-3">
                                        <label for="medicine">Medicine Name: </label>
                                            <input type="text" class="form-control" name="medicine" value="<?php echo strtoupper($get_name_medicine) ?>" readonly>
                                            <input type="hidden" class="form-control" name="mid" value="<?php echo $set_medicine ?>" readonly>
                                    </div>
                                    
                                   <!-- Cost & Selling Price -->
                                   <div class="row">
                                        <div class="col-md-6">
                                           <div class="form-group mb-3">
                                                <label for="costPrice">Cost Price: </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend"> <?php echo $currency; ?> </span>
                                                    </div>
                                                    <input type="number" class="form-control text-dark cp" name="cost-price" id="cost-price_" placeholder="0.00" value="<?php echo $get_cost_price?>" readonly>
                                                </div>
                                            </div>  
                                           
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="sellingPrice">Selling Price:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend"><?php echo $currency; ?></span>
                                                    </div>
                                                    <input type="number" class="form-control text-dark sp" id="selling-price" placeholder="0.00" value="<?php echo $get_selling_price?>" readonly>
                                                </div>
                                        </div>
                                            
                                    </div>

                                   </div> 
                                                                      
                                
                                </div> 
                                
                                <div class="col-md-6">   
                                       <!-- Supplier Name -->
                                    <div class="form-group mb-3">
                                        <label for="supplier">Supplier Name: </label>
                                                <div class="dropdown bootstrap-select mb-0 dropup">
                                                    <select class="wide supplier border-dark" id="supplier" name="supplier">
                                                        <option value="" data-display="Select" disabled selected hidden>Nothing</option>
                                                       <?php 
                                                        $query_get_suppliers = mysqli_query($connect_db,"SELECT * FROM `tbl_suppliers`");
                                                        ?>
                                                        <?php
                                                            while ($each_supplier = mysqli_fetch_array($query_get_suppliers)) { ?>
                                                        <option value="<?php  echo $each_supplier['supplier_id'] ?>">
                                                            <?php echo $each_supplier['supplier_name']; ?></option>
                                                        <?php }
                                                        mysqli_free_result($query_get_suppliers);
                                                        ?>
                                                    </select>
                                                </div>
                                    </div> 
                                                
                                        <!--  --> 

                                    <div class="row">
                                        <div class="col-md-4 ">
                                           <div class="form-group mb-3">
                                                <label for="costPrice">Enter Quantity <span class="text-danger">*</span></label>
                                                <input type="number" min="1" class="form-control text-dark text-center qty" name="quantity" id="quantity_" placeholder="Quantity" onkeypress="return isNumberKey(event)" required="">
                                            </div>  
                                           
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="totalPrice">Total Price: </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend"> <?php echo $currency; ?> </span>
                                                    </div>
                                                    <input type="number" class="form-control text-dark totamt" id="total-amount_" placeholder="0.00" name="total-price" readonly="">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="totalPrice">Purchase Amount: </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend"> <?php echo $currency; ?> </span>
                                                    </div>
                                                    <input type="text" class="form-control text-dark pay_amt" id="pay-amount" placeholder="0.00" name="pay-amount" required="" onkeypress="return isNumberKey(event)" required="">
                                                </div>
                                            </div>
                                        </div>
                                   
                                </div>

                            </div>
                                </div>
                                                        
                            <div class="row d-flex justify-content-center">
                                <button class="btn btn-pink font-weight-bold waves-effect text-center mr-3" type="submit" name="addstock" id="addstock" onclick="">+ Add Stock </button>

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
    
    $(document).ready(function(){
        var grand = 0;
        var count = 0;

         var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }

        //mice select
        $('.supplier').niceSelect();

        $(document).on('blur', '[id^=total-amount_]', function(){
            var sub;
            var i = $('#total-amount_' + id).val();
            var st = $('.stock-total' + id).val();
            sub = st + i;
            $('#stock-amount_').val(parseFloat(sub).toFixed(2));
        })

        //calculate stock total amount
        $(document).on('blur keyup', '[id^=quantity_]', function(){
            calculateTotal();
        })
        
        //
        $(document).on('blur keyup', '#quantity_', function(){
            if ($(this).val() == "") {
                $(this).css("borderColor", "red");
            }else{
                $(this).css("borderColor", "#145388");
            }
        }) 
        
        $(document).on('blur', "[id^=cost-price_]", function(){
            calculateTotal();
        });

        $(document).on('click', '#go-back', function(){
            const url = 'stocks.alerts.php';
            window.location.href = url;
        });

        // saves stocks
        $('#add-stock').submit(function(e) {
            if($('#quantity_').val() === "" || $('#pay-amount').val() === ""){
                $('#pay-amount').focus();
                swal.fire('Sorry!','Please, fill all required inputs','warning');
                return;
            }

            e.preventDefault();
            var formdata = $(this).serialize();

            // ajax api call to save record
            $.ajax({
                    url: 'api_calls/stock_api/add.stock.php',
                    type: 'POST',
                    data: formdata,
                    success: function(res) {
                            swal.fire(
                                'Great!', 
                                'This stock has been recorded successfully..', 
                                'success').then(function() {
                                window.location.href = 'stocks.alerts.php'
                            }); 
                                           

                    },
                    error: function(res) {
                        console.log(res);  
                        swal.fire(
                            'Error!', 
                            'Stocks could not be added, ajax error or request timed out..', 
                            'error').then(function() {
                            window.location.href = 'add.stock.php'
                        });
                    }
            });
        });


    function calculateTotal(){
            var total = 0;
            var grand = 0;
            $("[id^='cost-price_']").each(function() {
            var id = $(this).attr('id');
            id = id.replace("cost-price_", '');
            var price = $('#cost-price_' + id).val();
            var quantity = $('#quantity_' + id).val();
            
            if (!quantity) {
                quantity = 1;
            }

            var total = price * quantity;
            $('#total-amount_' + id).val(parseFloat(total).toFixed(2));
            totalAmount += total;
            });
            
            $('#total-amount_').val(parseFloat(totalAmount).toFixed(2));
           
          
    }

    function clearInputs(){
        $("#cost-price_").val('');
        $("#selling-price").val('');
        $("#quantity_").val('');
        $("#total-amount_").val('');
        $("#medicine").val(null).trigger('change');
        $("#supplier").val('').niceSelect('update');

    }
    
        
});
  
</script>

<script>
    function validate(){
        if($('#quantity_').val() === "" || $('#pay-amount').val() === ""){
            $('#pay-amount').focus();
            swal.fire('Sorry!','Please enter quantity and purchase amount','warning');
        }
    }
    </script>


