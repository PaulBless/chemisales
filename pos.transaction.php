<?php 


   // Required Templates Resources
    require_once 'session.php';   // Check if User is Authenticated

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

     

## Database Queries

 ## 2 = Get List of Medicines < Products >
 // -- Query 2 Start --- 
    $products_array = [];

    // $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` ORDER BY `medicine_name` WHERE `is_expired`='0' ASC")or die(mysqli_error($connect_db));
    
    $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` ORDER BY `medicine_name` ASC")or die(mysqli_error($connect_db));
    
    while ($each_product = mysqli_fetch_array($get_products)) { 
    $product_id = $each_product['mid'];
    $product_price = $each_product['selling_price'];
    $product_name = $each_product['medicine_name'];
    
    $products_array += [$product_price=>$product_name]; 

    }
 // --- Query 2 End --


 ## Query 3 - Get Currency
    $sql_currency = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '7'")or die(mysql_error($connect_db));
    $currency = mysqli_fetch_assoc($sql_currency);
    $get_currency_value = $currency['settings_ans'];

 // -- Query Ends Here

 
 // GENERATING SALES ORDER NUMBERS FOR EACH SALE ITEM 
 //global variables
$last_id = "";           //variable to hold last saved sale id
$application_id = "";    //application number
$salesNumber = "";		//variable to generate unique application numbers 
$check_app_id = "";
$check_app_no = "";	    
 //query to fetch last application year
$res = "SELECT * FROM `tbl_special_sales` ORDER BY `sales_datetime` DESC";
$rs2 =mysqli_query($connect_db, $res);
$rows =mysqli_fetch_array($rs2);
if($rows > 0){
	//no record found
	$check_date = date('Y', strtotime($rows['sales_datetime'])); //last date 
	$check_app_id = ($rows['ssid']);		//last id
	$check_app_no = ($rows['sales_number']);		//last sales no
    
	# get last application number,
	## and split to get first four digit,
	## remove the year part and increment by 1 as new sales number
	$first_four = substr($check_app_no, 0, 4);
	$check_app_id = $first_four + 1;	## set last id to 1
	$application_id = sprintf("%04d", $check_app_id);
	$salesNumber = $application_id;
	//  echo "<script>alert('".$salesNumber."')</script>";

	
	}else{ 
	  $check_app_id = 1;
	 $application_id = sprintf("%04d", $check_app_id);
	$salesNumber = $application_id;
	//  echo "<script>alert('".$salesNumber."')</script>";
	}
## End Here

## Query 3 - Get Currency
    $sql_currency = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '7'")or die(mysql_error($connect_db));
    $currency = mysqli_fetch_assoc($sql_currency);
    $get_currency_value = $currency['settings_ans'];

// -- Query Ends Here



?>


<style type="text/css">
    .custom-input{
        text-align: right !important;
        border: none !important;
    }
    .custom-input .name-type{
        /* width: 150px; */
    }
     /* animated search button */
     input[type=text] {
        /* width: 75px; */
        /* -webkit-transition: width 0.4s ease-in-out; */
        /* transition: width 0.4s ease-in-out; */
    }

    /* When the input field gets focus, change its width to 100% */
    input[type=text]:focus {
        /* width: 100%; */
    }

    /* toggled search bar  */
    .search-form-wrapper {
        display: none;
        position: absolute;
        left: 0;
        right: 0;
        padding: 20px 15px;
        margin-top: 50px;
        background: url(/resources/images/misc/bg_search-open.png) right center no-repeat #f89d1c;
    }
    .search-form-wrapper.open {
        display: block;
    }

    .page-title-box .search-icon:hover{
        color: #E60DA1;
	    border-bottom: none;
    }

     .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 4px;
        height: 36px !important;
        /* padding-top: 5px !important; */
    }

</style>
</head>
<body>

<!-- ========================= SECTION INTRO START ========================= -->



<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y" >
    <div class="container">
    
        <!-- ============ Choose Medicine & Add to Cart Section Start ============== -->
        <!-- <div class="row justify-content-center bg-light mt-5 mb-0"> -->
        <div class="row justify-content-center mt-5 mb-0">
            
            <div class="col-md-8 mt-2">
                    <form action="" method="post" name="addform">
                        <div class="row mb-1">
                            <div class="col-lg-12 col-md-12 col-sm-12" >
                                <input type="text" name="barcode" id="barcode" class="form-control text-dark text-center border-dark" placeholder="Scan Item Barcode">
                            </div>  
                        </div>

                        <div class="row">
                               
                                <div class="col-md-9 pt-0">
                                    <!-- select drugs name <old> -->
                                    <select class="form-control drug-name select-custom mb-0" name="drugName" id="drugName_1" required>
                                        <option class="default-selection " style="display: none;" value="" selected disabled hidden>Select Drug or Medicine </option>
                                        <?php
                                            // query db to get all list of drugs, for user selection
                                            // $get_all_drugs = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE `medicine_expiry_date` >= curdate() ORDER BY `medicine_name` ASC")or die(mysqli_error($connect_db));
                                            $get_all_drugs = mysqli_query($connect_db,"SELECT mid, medicine_name, selling_price, medicine_description FROM `tbl_medicines` m, `tbl_temporary_stocks` ts WHERE ts.`medicine_id`=m.`mid` AND ts.`stock_level`!='0' AND `medicine_expiry_date` >= curdate() ORDER BY `medicine_name` ASC")or die(mysqli_error($connect_db));
                                            while ($drugs_list = mysqli_fetch_array($get_all_drugs)) { 
                                            ?>
                                            <option value="<?php echo $drugs_list['mid']; ?>"><?php echo $drugs_list['medicine_name'];?> - <?php echo $drugs_list['medicine_description']; ?> | Gh¢: <?php echo $drugs_list['selling_price']; ?></option>
                                            <?php 
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <input type="number" value="1" min="1" name="quantity" id="quantity" class="form-control text-dark text-center border-secondary">
                                </div>                                 
     
                            <!-- ===== Display Drug Details As User Choose Unique Drug Item from the dropdown option ===== -->
                            <!-- to be used to display drug price for each selected item from the dropdown, if value id change by user  -->
                            <div class="row drug-cart-holder d-none" id="drugs-holder">
                                <input type="text" name="price" id="price" readonly class="form-control price" autocomplete="off">
                                <input type="text" name="medicine-name" id="name" readonly class="form-control name" autocomplete="off">
                                <input type="text" name="code" id="code" readonly class="form-control code" autocomplete="off">
                                <input type="text" name="drugid" id="id" readonly class="form-control id" autocomplete="off">
                                <input type="text" name="available" id="left" readonly class="form-control left" autocomplete="off">
                            </div>
                            <!-- ===== Display Drug Details As User Choose Unique Drug Item from the dropdown option ===== -->

                                <div class="col-md-1">
                                    <button class="btn btn-success add-to-cart" data-style="slide-up" type="submit" name="add-cart" id="add-to-cart" ><i class="fe-plus font-weight-bold "></i> </button>
                                </div>
                        </div>  
                       
                    </form>
            </div>
        </div>
        <!-- ========== Choose Medicine Section End ==============  -->

                
           
        <!-- ========================= Pay Section Section Start  ========================= -->
        <div class="row justify-content-center " >
            <aside class="col-md-8" id="shopping-cart">

                    <form id="pos-form" method="post">		
                    
                        <article class="card mt-2" style="border: 1px solid #3a343a;">
                            <header class="card-header bg-dark d-none">
                                <strong class="d-inline-block mr-3 text-dark float-right">Receipt #: <span class="text-white font-weight-light ml-1" style="letter-spacing: 1px;"> <?php echo $salesNumber; ?></span></strong>
                            </header>
                    
                            <div class="table-responsive" id="cart-info-details">
                            
                                <table class="table table-hover tbl-products">
                                    <!-- <thead class="bg-dark text-white text-center "> -->
                                    <thead class="bg-light text-center font-weight-bold" style="color: #145388;">
                                        <tr >
                                            <td width="40%">Drug or Medicine</td>
                                            <td>Price</td>
                                            <td>Qty</td>
                                            <td>Total</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody> 
                               	
                                    
                                    </tbody>
                                </table>
                              
                            </div> <!-- table-responsive .end// -->

                            <!-- Sale value details -->
                            <div class="pt-3 mx-2 mb-2 border-top " >
                                
                                <!--=============================== -->
                                <dl class="dlist-align d-none">
                                    <dt class="font-weight-lighter">Subtotal:</dt>
                                    <dd class="text-right"><input type="text" class="custom-input" readonly name="subTotal" id="subTotal" value="0"></dd>
                                </dl>

                                <dl class="dlist-align d-none">
                                    <dt  class="font-weight-lighter">Discount:</dt>
                                    <dd class="text-right text-danger"><input class="custom-input" type="text" readonly name="discountTotal" id="discountTotal" value="0"></dd>
                                </dl>

                                <dl class="dlist-align d-none">
                                    <dt class="font-weight-lighter">Grand Total:</dt>
                                    <dd class="text-right text-dark"> <input class="custom-input totalAftertax" type="text" readonly name="totalAftertax" ></dd>
                                </dl>

                                <hr >

                    <input type="text" class="form-control col-2 d-none" name="sales-number" id="sales-number" value="<?php echo $salesNumber; ?>"/>

                    <input type="hidden" value="<?php  echo $id; ?>" name="user-id" id="user-id" />   

                                
                                <div class="row mb-2">
                                    <div class="col-md-6 ">
                                        <input class="form-control d-none border-secondary" name="taxRate" autocomplete="off" id="taxRate" type="number" min="0" placeholder="Tax Allowed"/>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control d-none border-secondary" name="discountRate" autocomplete="off" id="discountRate" type="number" min="0.1" placeholder="Discount Allowed"/>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control border-secondary" name="taxAmount" type="hidden" placeholder="Tax Allowed"/>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control border-secondary" name="discountAmount" type="hidden" placeholder="Tax Allowed"/>
                                    </div>
                                </div>

                                   
                                <!-- Amount Due for Payable -->
                                <div class="my-2 text-center">
                                    <input type="text" class="custom-input text-danger font-weight-bold" name="amountDue" id="amountDue" readonly value="0" style="text-align: center !important; font-size:20px">
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-4 ">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"> Grand Total: <?php echo $get_currency_value; ?></div>
                                            </div>
                                            <input value="" readonly type="text" class="form-control text-right text-dark " name="grandTotal" id="grandTotal" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"> Balance: <?php echo $get_currency_value; ?></div>
                                            </div>
                                            <input value="" readonly type="text" class="form-control text-right text-dark " name="balance" id="balance" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control text-center text-purple font-weight-bold border-dark" name="amountPaid" autocomplete="off" id="amountPaid" type="text" min="1" maxLength="8" onkeypress="return isNumberKey(event)" placeholder="Amount Paid"/>
                                    </div>
                                </div>

                             

                               <!-- Action Buttons -->
                                <div class="row ">
                                    <input type="hidden" class="form-control" id="after-sales">

                                    <div class="col-md-6">
                                        <button type="button" name="pay" id="1" class="btn btn-success btn-submit w-100 my-2 font-weight-bold" style="letter-spacing: 1px;"> Pay Only </button>
                                    </div> 
                                    <div class="col-md-6">
                                        <button type="submit" name="pay-print" id="2" class="btn btn-primary btn-submit w-100 my-2 font-weight-bold" style="letter-spacing: 1px;"> <i class="mdi mdi-printer"></i> Pay + Print </button>
                                    </div>
                                    
                                </div>
                                <div class="row ">
                                    
                                    <div class="col-md-12">
                                        <button type="button" name="pay-print" id="clear-all" class="btn btn-danger w-100 my-0 font-weight-bold" style="letter-spacing: 1px;">  Clear All </button>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </article>
                        
                    </form>
            </aside>
        </div> 
        <!-- ========================= Pay Section End  //  ========================= -->
            
            
        <!-- Empty Cart -->
        <div class="row justify-content-center d-none">
            <div class="col-md-8 mt-2">
                <button type="button" id="clear-all" class="btn btn-danger d-none w-100 my-2 font-weight-bold" style="letter-spacing: 1px;"> Clear All </button>
            </div>
        
        </div>



    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->



<?php 
require_once 'modals/user_modal.php';
require_once 'template/footer.client.php';  
?>


<script>

$(document).ready(function(){
    var found = false;

    var items_array = {};
    var quantity_array = {};

    // show timer alert
    $("#clear-all").on('click', function(){
        var t;
        Swal.fire({
            title:"<h4 class='text-dark font-weight-bold'>Please Wait!</h4>",
            html:'Deleting and refreshing cart in <strong class="text-info"></strong> seconds.',
            timer:2e3,
            onBeforeOpen:function(){
                emptyCart();
                calculateTotal();
                Swal.showLoading(),
                t=setInterval(function(){
                    Swal.getContent().querySelector("strong").textContent=Swal.getTimerLeft()},100)},
            onClose:function(){clearInterval(t)}}).then(function(t){t.dismiss===Swal.DismissReason.timer&&console.log("I was closed by the timer")
        })

    })
   
    // function to empty the cart
    function emptyCart(){
        $("tbody").children().remove() // clear all rows data tbody tag
        $('#quantity').val('1');
    }

    // allow add to cart button
    function allowAddBtn(){
        $("#add-to-cart").attr('disabled', false);
    }

    //set default option value for select drug
    function setDefaultOption(){
        const defaultOption = $("#drugName_1").find('.default-selection');
        $("#drugName_1").select2("val", defaultOption.val());
    }
    // disable add to cart button
    function disableBtn(btn){
	    document.getElementById(btn.id).disabled = true;
	    // alert("Button has been disabled.");
	}
    
    function checkValue()
    {
        var combo = document.getElementById("drugName_1");
        if(combo.selectedIndex <=0)
        {
        alert("Please Select Valid Value");
        }
        
        if(document.addform.drugName.value == "")
        {
            $.toast({
            heading: "Error",
            text: "Select valid drug or medicine name",
            position: "top-center",
            loaderBg: "#bf441d",
            icon: "error",
            stack: "1"
            });
            document.addform.drugName.focus();
            return false;
        }
    }

    $('#switch_classic').click(function(){
        // set the item in localStorage
        localStorage.setItem('view', 'classic');
        window.location.href='sales-point-classic.php';
    })

    $('.alternatives').hide();

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

    $('.datepicker').datepicker({
        orientation: 'bottom',
        autoclose: true
    })

    $(document).on('click', '#checkAll', function() {
        $(".itemRow").prop("checked", this.checked);
    });
    
    
    // select drug onchange function : get unique drug info when the user select drug-name
    $(document).on('change', '.drug-name', function() {
        var id = $(this).attr('id');
        var productId = $(this).val();

        var idNumber = id.substr(12);

            $.ajax({
            url: 'api_calls/sales_api/fetch.drug.details.php',
            type: 'POST',
            data: 'productId=' + productId,
            success: function(res) {
                $('#price').val(res.selling_price);
                $('#name').val(res.medicine_name);
                $('#id' ).val(res.mid);
                $('#code' ).val(res.medicine_code);
                $('#left' ).val(res.stock_level);
                allowAddBtn();
            },
            error: function() {}
        })
    })

    // triggers to add the drug-details to cart
    $("#add-to-cart").on("click", function(){
        var qty_left = document.getElementById('left').value;
        var qty_entered = document.getElementById('quantity').value;
        var left = $("#left").val();
        var entered = $("#quantity").val();

        // check if medicine or drug name has been selected by user
      
        if(document.addform.drugName.value == "")
        {
            $.toast({
            heading: "Error",
            text: "Select drug or medicine name from the list below",
            position: "top-center",
            loaderBg: "#BF441D",
            icon: "error",
            stack: "1"
            });
            document.addform.drugName.focus();
            return false;
        }
      
            // get drugs info
            var drug_id = $("#id").val();
            var price = $("#price").val();
            var name = $("#name").val();
            var quantity = $("#quantity").val();
            var qtyleft = $("#left").val();
            var total = quantity * price;
        
            // Add & Show Cart-Details for printable
            addDrugToCart(name,price,quantity,total,drug_id,qtyleft);   // add drug to cart
            $(".select-custom").val(null).trigger("change");  //reset dropdown
            $(this).prop("disabled", true);
            $('#quantity').val('1');
        
       
    })

    // remove items from cart
    $(document).on('click', '.removeRows', function() {
        $(this).closest('tr').remove();
        calculateTotal();
        $('#amountPaid').val('');
    });

    
    // get user action type (pay or pay+print)
     $(document).on('click', '.btn-submit', function(e) {
        e.preventDefault();
        $('#after-sales').val($(this).attr('id'));
        $('#pos-form').submit();
    })

    // submit pos form
    $(document).on('submit', '#pos-form', function(e) {
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajax({
            url: 'api_calls/sales_api/insert.sales.php',
            type: 'POST',
            data: formdata,
            success: function(res) {
                if (res === 'empty') {
                     Swal.fire(
                        'Error!',
                        'Please, Select/Add At Least One Medicine and Enter Pay Amount!',
                        'error'
                    )
                } else if( res === 'error'){
                    swal.fire(
                        'Error!',
                        'Kindly Add Medicine and Enter correct Payment Amount... ',
                        'error'
                    )
                } else if(res === 'less'){
                    swal.fire('Error','Quantity Entered is more than Medicine Available, Check...', 'warning')
                } else {
                    if ($('#after-sales').val() === '1') {
                        window.location.href = 'pos.php'
                    } else {
                      var new_location = "print.sales.php?salesid=" + $('#sales-number').val();
                      var print_sale = "printing.php?salesid=" + $('#sales-number').val();
                        // window.location.href = new_location;
                        window.open(print_sale, '_blank');
                        location.reload();
                       
                    }
                }
            },

            error: function() {}
        })

    })

   

    $(document).on('blur keyup', "[id^=quantity_]", function() {
        calculateTotal();
    });

    $(document).on('blur', "[id^=price_]", function() {
        calculateTotal();
    });

    $(document).on('blur', "#taxRate", function() {
        calculateTotal();
    });
    $(document).on('blur', "#discountRate", function() {
        calculateTotal();
    });

    $(document).on('blur keyup', "#amountPaid", function() {
        var amountPaid = $(this).val();
        var totalAftertax = $('.totalAftertax').val();
        console.log(totalAftertax);
        if (amountPaid && totalAftertax) {
            totalAftertax = totalAftertax - amountPaid;
            $('#amountDue').val((totalAftertax.toFixed(2)));
            $('#balance').val((totalAftertax.toFixed(2)));
        } else {
            $('#amountDue').val((totalAftertax.toFixed(2)));
            $('#balance').val((totalAftertax.toFixed(2)));
        }
    });


})


 var count  = 0;    // global count variable for adding table rows 

function addDrugToCart(productName,unitPrice,quantity,total,product_id, available){
    var htmlRows = '';
    htmlRows += '<tr>';
    htmlRows +=
    '<td><input type="text" readonly required="required" name="medicineName[]" id="name_' +
    count + '" class="form-control form-control-sm " autocomplete="off" value="'+productName+'"><input type="text" readonly name="medicine_id[]" id="product_id_' +
    count + '" class="form-control form-control-sm d-none" autocomplete="off" value="'+product_id+'"><input type="text" readonly class="form-control form-control-sm d-none" name="available[]" id="available" value="'+available+'"></td>';


    htmlRows +=
    '<td><input type="number" readonly required="required" name="price[]" id="price_' +
    count + '" class="form-control form-control-sm text-right" autocomplete="off" value="'+unitPrice+'"></td>';

    htmlRows +=
    '<td><input type="number" required="required" name="quantity[]" id="quantity_' +
    count + '"  class="form-control form-control-sm text-center" autocomplete="off" value="'+quantity+'"></td>';

    htmlRows +=
    '<td><input type="number" readonly required="required" name="total[]" id="total_' +
    count + '" class="form-control form-control-sm text-right" autocomplete="off" value="'+total+'"></td>';

    htmlRows +=
    '<td width="5"> <a href="#" class="btn btn-outline-danger btn-sm removeRows">x</a></td>';

     htmlRows += '</tr>';

    $('.tbl-products').append(htmlRows);

    calculateTotal();

    count++
}


function calculateTotal() {
    var totalAmount = 0;
    $("[id^='price_']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("price_", '');
        var price = $('#price_' + id).val();
        var quantity = $('#quantity_' + id).val();
        if (!quantity) {
            quantity = 1;
        }
        var total = price * quantity;
        $('#total_' + id).val(parseFloat(total).toFixed(2));
        totalAmount += total;
    });
    $('#subTotal').val(parseFloat(totalAmount).toFixed(2));
    $('#grandTotal').val(parseFloat(totalAmount).toFixed(2));
    var taxRate = $("#taxRate").val();
    var discountRate = $("#discountRate").val();
    var subTotal = $('#subTotal').val();
    if (subTotal) {
        var taxAmount = subTotal * taxRate / 100;
        var discountAmount = subTotal * discountRate / 100;
        $('#taxAmount').val(taxAmount.toFixed(2));
        $('#discountAmount').val(discountAmount.toFixed(2));
        subTotal = parseFloat(subTotal) + parseFloat(taxAmount) - parseFloat(discountAmount);
        $('.totalAftertax').val(subTotal.toFixed(2));
        var amountPaid = $('#amountPaid').val();
        var totalAftertax = $('.totalAftertax').val();
        if (amountPaid && totalAftertax) {
            totalAftertax = totalAftertax - amountPaid;
            $('#amountDue').val(totalAftertax.toFixed(2));
        } else {
            $('#amountDue').val(subTotal.toFixed(2));
        }
    }
}

function validate(){
    var ddl = document.getElementById("product_name");
    var selected_drug_value = ddl.options[ddl.selectedIndex].value;
    if (selected_drug_vbalue == "")
    {
        $.toast({
            heading: "Error",
            text: "Medicine or Drug name is required",
            position: "top-center",
            loaderBg: "#8a6d3b",
            icon: "warning",
            stack: "1"
            });
            ddl.focus();
            return false;
    }
}

</script>

<script>
  $('[name="new-password"],[name="confirm-password"]').keyup(function(){
      var pass = $('[name="new-password"]').val()
      var cpass = $('[name="confirm-password"]').val()
      if(cpass == '' || pass == ''){
        $('#pass_match').attr('data-status','')
      }else{
        if(cpass == pass){
          $('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</>')
        }else{
          $('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
        }
      }
    })
</script>
</body>
</html>