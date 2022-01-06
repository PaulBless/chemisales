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

?>

<style>
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 4px;
        height: 36px !important;
        /* padding-top: 5px !important; */
    }
</style>
<?php

## Supplier List Array
    $suppliers_array = [];
    $get_suppliers = mysqli_query($connect_db,"SELECT * FROM `tbl_suppliers`")or die(mysqli_error($connect_db));
                                            
    while ($each_supplier = mysqli_fetch_array($get_suppliers)) { 
        $supplier_id = $each_supplier['supplier_id'];
        $supplier_name = $each_supplier['supplier_name'];
        
        $suppliers_array += [$supplier_id=>$supplier_name]; 
    }

## Medicines Array
    $products_array = [];
    $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines`")or die(mysqli_error($connect_db));
                                            
    while ($each_product = mysqli_fetch_array($get_products)) { 
        $product_id = $each_product['mid'];
        $product_name = $each_product['medicine_name'];
        
        $products_array += [$product_id=>$product_name]; 
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
                            <ol class="breadcrumb m-0" style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Stocks</a></li>
                                <li class="breadcrumb-item active"> Stock Entry</li>
                            </ol>

                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Add New Stock </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->



            <!-- Add Medicine -->
            <div class="row">
                <div class="col-md-12">
                     <div class="card-box">
                        <form action="" id="add-medicine" name="addform" class="needs-validation was-validatedd">
                            <div class="row">

                                <div class="col-md-6">
                                    <!-- Supplier Name -->
                                    <div class="form-group mb-3">
                                        <label for="supplier">Supplier Name: </label>
                                            <?php 
                                                $query_get_suppliers = mysqli_query($connect_db,"SELECT * FROM `tbl_suppliers`");
                                                if(mysqli_num_rows($query_get_suppliers) > 0){
                                                    ?>
                                                     <div class="dropdown bootstrap-select mb-0 dropup">
                                                    <select class="wide supplier border-dark" id="supplier" name="supplier">
                                                        <option value="" data-display="Select" disabled selected hidden>Nothing</option>
                                                       
                                                        <?php
                                                            while ($each_supplier = mysqli_fetch_array($query_get_suppliers)) { ?>
                                                        <option value="<?php  echo $each_supplier['supplier_id'] ?>">
                                                            <?php echo $each_supplier['supplier_name']; ?></option>
                                                        <?php }
                                                        mysqli_free_result($query_get_suppliers);
                                                        ?>
                                                    </select>
                                                </div>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <div class="dropdown bootstrap-select mb-0 dropup">
                                                        <select class="wide supplier border-secondary" id="supplier" name="supplier">
                                                        <option value="" data-display="Select" disabled selected hidden>Nothing</option>
                                                        <option value="N/A" data-display="Not Applicable" >Not Applicable</option>
                                                        </select>
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                               
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
                                                    <input type="number" class="form-control text-dark cp" name="cost-price" id="cost-price_" placeholder="0.00" readonly>
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
                                                    <input type="number" class="form-control text-dark sp" id="selling-price" placeholder="0.00" readonly>
                                                </div>
                                        </div>
                                            
                                    </div>

                                   </div> 
                                                                      
                                
                                </div> 
                                
                                <div class="col-md-6">   
                                        <!-- Medicine Name --> 
                                           <div class="form-group mb-3">
                                                <label for="medicine">Medicine Name: <span class="text-danger">*</span></label>
                                                    <select class="form-control medicine-name select-custom" id="medicine" name="medicine" required>
                                                        <option value="" disabled selected hidden>Select Medicine Name</option>
                                                       <?php 
                                                        // $query_get_medicines = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines`");
                                                        $query_get_medicines = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines`");
                                                        ?>
                                                        <?php
                                                            while ($each_medicine = mysqli_fetch_array($query_get_medicines)) { ?>
                                                        <option value="<?php  echo $each_medicine['mid'] ?>">
                                                            <?php echo $each_medicine['medicine_name']; ?></option>
                                                        <?php }
                                                        mysqli_free_result($query_get_medicines);
                                                        ?>
                                                    </select>

                                            </div>  
                                                
                                    <!--  --> 
                                    <div class="row">
                                        <div class="col-md-6 mt-1">
                                           <div class="form-group mb-3">
                                                <label for="costPrice">Enter Quantity <span class="text-danger">*</span></label>
                                                <input type="number" min="1" class="form-control text-dark qty" name="quantity" id="quantity_" placeholder="Quantity" onkeypress="return isNumberKey(event)" required="">
                                            </div>  
                                           
                                        </div>
                                        <div class="col-md-6 mt-1">
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
                                   
                                </div>

                            </div>
                                </div>
                                                        
                            <div class="row d-flex justify-content-center">
                                <button class="btn btn-pink waves-effect text-center mr-3" type="button" name="addstock" id="addstock">+ Add Item </button>
                            </div>

                        </form>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->


            <!-- Add Stocks Using Bootstrap Table Format, to be able to add more medicines at a single time -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box" style="border: 1px solid #14324d;">
                        <form method="post" id="add-stocks-form"> 
                               
                        <table id="tbl-stocks" class="table table-hover table-striped dt-responsive w-100">
                                <thead class="thead-light text-white">
                                    <tr>
                                        <th width="40%">Medicine Name</th>
                                        <th >Price</div> </th>
                                        <th >Quantity</div></th>
                                        <th >Total</div></th>
                                        <th ></th>
                                        <th class="d-none">Supplier</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                                
                        </table>

                            <div class="form-group d-none">
                            <input type="text" class="form-control" name="stockid" id="stockid" value="<?php echo $st_value; ?>"/>
                            <input type="text" class="form-control border-pink " name="purchaseid" id="purchaseid" value="<?php echo $pc_value; ?>"/>
                            <input type="text" class="form-control" name="selected-drug" id="selected-drug"/>
                            <input type="text" class="form-control" name="drug-id" id="drug-id"/>
                            <input type="text" class="form-control" name="available" id="available"/>
                        </div>

                            <div class="form-group float-right mt-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend"><b>Payment: <?php echo $currency; ?></b>  </span>
                                    </div>
                                <input onkeypress="return isNumberKey(event)" maxLength="9" type="text" class="form-control text-dark font-weight-bold" style="width: 100px;" name="payment-amount" id="payment-amount" placeholder="0.00">
                                </div>
                            </div> 
                            <div class="form-group float-left mt-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend"><b>Stock Total: <?php echo $currency; ?></b>  </span>
                                    </div>
                                <!-- <input onkeypress="return isNumberKey(event)" maxLength="9" type="text" class="stock-total form-control text-dark font-weight-bold" style="width: 100px;" name="stock-amount" id="stock-amount_" placeholder="0.00"> -->
                                <input class="stock_total form-control text-dark" style="width: 100px;" name="total_stock" id="stockTotal" placeholder="0.00">
                                <span id="sum" class="text-purple">0</span>
                                </div>
                            </div>

                           
                            <div class="row d-flex justify-content-center mt-4 "> 
                                <button class="btn btn-success btn-lg waves-effect text-center font-weight-bold mr-1" type="submit" name="save-all" id="save-all" onclick=""> <i class="mdi mdi-content-save-outline"></i> Save Stock Items</button>
                                <button class="btn btn-danger btn-lg waves-effect text-center font-weight-bold ml-1" type="button" onclick="return window.location.href='admin.dashboard.php'"> <i class="mdi mdi-close"></i> Cancel </button>
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>

        </div> <!-- container -->

    </div> <!-- content -->


    <?php require_once 'template/footer.client.php';   ?>

    
<script type='text/javascript'>
    
    $(document).ready(function(){
       const price_value = 0;  // store each unit price of medicine in variable 
        var grand = 0;
        var count = 0;

         var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }

        //custom select
        $('.select-custom').select2();
        $('.supplier').niceSelect();

        $('.select-custom').select2({
        sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
        });

        $(".select-custom").on("select2:select", function(evt) {
            var element = evt.params.data.element;
            var $element = $(element);
            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
        });

       
        $(".select").change(function () {
            var str = "";
            $("select option:selected").each(function () {
                  str += $(this).text() + " ";
            });
            //   $("div").text(str);
              alert(str);
        }).trigger('change');

        // Loop through each div element with the class box
        $(".box").each(function(){
            // Test if the div element is empty
            if($(this).is(":empty")){
                $(this).css("background", "yellow");
            }
        });
        
        // select drug onchange function : get unique drug info when the user select drug-name
        $(document).on('change', '.medicine-name', function() {
            var id = $(this).attr('id');
            var productId = $(this).val();
            var idNumber = id.substr(12);

                $.ajax({
                url: 'api_calls/stock_api/get.drug.info.php',
                type: 'POST',
                data: 'productId=' + productId,
                success: function(res) {
                        $('#cost-price_').val(res.cost_price);
                        $('#selling-price').val(res.selling_price);
                        $('#selected-drug').val(res.medicine_name);
                        $('#drug-id').val(res.mid);
                },
                error: function() {

                }
            })
        })

        // add more items or medicines
        $(document).on('click', '#addstock', function() {
            var supplier_id = $("#supplier").val();
            var medicine = $("#medicine").val();
            var drug = $("#medicine").text();
            var qty = $(".qty").val();
            var sp = $(".sp").val();
            var cp = $(".cp").val();
            var tamt = $(".totamt").val();
            var drug_id = $("#drug-id").val();
            var drug_name = $("#selected-drug").val();

            // check if medicine or drug name has been selected by user
            if(document.addform.medicine.value == "")
            {
                $.toast({
                heading: "Error",
                text: "Please, Select a Medicine First",
                position: "top-center",
                loaderBg: "#BF441D",
                icon: "error",
                stack: "1"
                });
                document.addform.medicine.focus();
                return false;
            }else if (document.addform.quantity.value == ""){
                $.toast({
                heading: "Error",
                text: "Enter Quantity of item you are Stocking",
                position: "top-center",
                loaderBg: "#BF441D",
                icon: "error",
                stack: "1"
                });
                document.addform.quantity.focus();
                return false;
            }else{
            
                addDrug(drug_name, cp, qty, tamt, drug_id, supplier_id);
                stockTotal();
            }

        });

        // remove an item row
        $(document).on('click', '.btn-remove', function() {
            $(this).closest('tr').remove();
            calculateTotal();
        });

        //calculate stock total amount
        $(document).on('blur keyup', '[id^=quantity_]', function(){
            calculateTotal();
        })
        

        // calculate stock-total
        // $("table").on("change", "input", function() {
        // $("#tbl-stocks").on("change", "input", function() {
        //     var row = $(this).closest("tr");
        //     var qty = parseFloat(row.find(".Qty").val());
        //     var price = parseFloat(row.find(".Price").val());
        //     var each_total = parseFloat(row.find(".Total").val());
        //     var total = qty * price;
        //     var sum_total += each_total;
        //     // $('.stock-total').val(isNaN(sum_total) ? "" : sum_total);
        //     row.find(".total").val(isNaN(total) ? "" : total);

        // });

        $(document).on('keyup, blur, input','#quantity_', function(){
            var act_price = $(".stock-total").val();
            var sell_price = $("#total-amount_").val();
            // var pro_price = parseInt(sell_price) - parseInt(act_price);
            var price = parseInt(sell_price) + parseInt(act_price);
            var percentage = Math.round((parseInt(pro_price)/parseInt(act_price))*100);
            var output = pro_price.toString().concat("(")+percentage.toString().concat("%)");
            // $("#profit-price").val(pro_price);
            // $("#profit-percent").val(percentage+"%");
            $(".stock-total").val(price);
        });

        //
        $(document).on('blur keyup', '#stock-amount', function(){
            if ($(this).val() == "") {
                $(this).css("borderColor", "red");
            }else{
                $(this).css("borderColor", "#145388");
            }
        }) 
        
        //
        $(document).on('blur keyup', '#payment-amount', function(){
            if ($(this).val() == "") {
                $(this).css("borderColor", "red");
            }else{
                $(this).css("borderColor", "#145388");
            }
        })

        $(document).on('blur', "[id^=cost-price_]", function(){
            calculateTotal();
        });


        // saves stocks
        $('#add-stocks-form').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

            // ajax api call to save records
            $.ajax({
                    url: 'api_calls/stock_api/record.stocks.php',
                    type: 'POST',
                    data: formdata,
                    success: function(res) {
                         if(res === 'error'){
                            swal.fire('Stock Error!', 'Please, Choose & Add Medicine Item(s) You Want to take Stocks, and Enter Total Stock/Payment Amount...', 'error');
                            $('#payment-amount').css("borderColor", "red");
                            $('#stock-amount').css("borderColor", "red");
                        } else if(res === 'empty'){
                            swal.fire('Oops!', 'Please choose and add Medicine Item', 'warning')
                        } else{
                               swal.fire(
                                'Great!', 
                                'Stocks Record Added successfully..', 
                                'success').then(function() {
                                window.location.href = 'stock.entry.php'
                            });
                        }

                    },
                    error: function(res) {
                        console.log(res);  
                        swal.fire(
                            'Error!', 
                            'Stocks could not be added, ajax error or request timedout..', 
                            'error').then(function() {
                            window.location.href = 'add.new.stock.php'
                        });
                    }
            });
        });

        $(document).on('change', '.totamt', function(){
            $(this).blur(function(){
				calculateSum();
			});
        });

        $(document).on('blur','.amount',function () {
            var total = 0;

            $(this).closest('tr').find('.amount').each(function () {
                total += parseInt($(this).val());
            });

            $(this).closest('tr').find('.total_bills').html(total);
            $('#stockTotal').html(total);
            // $('#stockTotal').val(total);
        });

function calculateSum() {
		var sum = 0;
		//iterate through each textboxes and add the values
		// $(".totamt").blur(function() {
            var cal = $('.totamt').val();
			//add only if the value is number
			if(!isNaN(cal.value) && cal.value.length!=0) {
				sum += parseFloat(cal.value);
			}

		// });

		//.toFixed() method will roundoff the final sum to 2 decimal places
		$("#sum").html(sum.toFixed(2));
}

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

function stockTotal(){
    var total = 0;
    $("[id^='total_']").each(function(){
        var id = $(this).attr('id');
        id = id.replace("total_", '');
        var price = $('#total_' + id).val();
        var stock = $('#stock-amount_' + id).val();
        if (stock = "") {
            stock = 0;
        }

        total = stock + price;
        $('#stock-amount_' + id).val(parseFloat(total).toFixed(2));
    })

}
        
// function addDrug(productName,unitPrice,quantity,total,product_id){
function addDrug(productName,unitPrice,quantity,total,product_id,supplier){
    var htmlRows = '';
    
    htmlRows += '<tr>';
    htmlRows +=
    '<td><input type="text" readonly required="required" name="name[]" id="name_' +
    count + '" class="form-control form-control-sm available" autocomplete="off" value="'+productName+'"><input type="hidden" readonly name="product_id[]" id="product_id_' +
    count + '" class="form-control form-control-sm available" autocomplete="off" value="'+product_id+'"></td>';

    htmlRows +=
    '<td><input type="number" readonly  required="required" name="price[]" id="price_' +
    count + '" class="form-control Price form-control-sm available" autocomplete="off" value="'+unitPrice+'"></td>';
    
    htmlRows +=
    '<td><input type="number" readonly required="required" name="quantity[]" id="quantity_' +
    count + '"  class="form-control Qty form-control-sm available text-center" autocomplete="off" value="'+quantity+'"></td>';

    htmlRows +=
    '<td><input type="number" readonly required="required" name="total[]" id="total_' +
    count + '" class="form-control amount form-control-sm available " autocomplete="off" value="'+total+'"></td>';
    
    htmlRows +=
    '<td width="5"> <a href="#" class="btn btn-outline-danger btn-sm btn-remove">x</a></td>';  

    htmlRows +=
        '<td><input type="hidden" readonly name="supplier[]" id="supplier_' +
        count + '" class="form-control form-control-sm available" autocomplete="off" value="'+supplier+'"></td>';

     htmlRows += '</tr>';

    $('#tbl-stocks').append(htmlRows);
    clearInputs();
    calculateTotal();

    count++
}



    });
  
</script>

<script>
    function validateInputs(){
    var st = $('#stock-amount').val();
    var pt = $('#payment-amount').val();
    
    if(st == ""){
        $.toast({
            heading: "Error",
            text: "Enter Stock Total Amount",
            position: "top-right",
            loaderBg: "#bf441d",
            icon: "error",
            stack: "4"
        });         
        $('#stock-amount').css("borderColor", "red");
        $('#stock-amount').focus();
        return false;
    }else if(pt == ""){
        $.toast({
            heading: "Error",
            text: "Enter Total Payment Amount",
            position: "top-right",
            loaderBg: "#bf441d",
            icon: "error",
            stack: "4"
        });     
        $('#payment-amount').css("borderColor", "red");
        $('#payment-amount').focus();
        return false;
    }
}
</script>