<?php 

// check if user is authenticated
require_once('session.php');

// Required Templates Resources
require_once('db/db.php');
require_once('template/header.client.php'); 
require_once('template/topnav.client.php'); 


## Database Queries

 ## 1 = Get & Generate New Sales Receipt or Order ID
 // -- Query 1 Start  --
    $each_sales_id_stmt = "SELECT * FROM `tbl_each_sales` ORDER BY `each_sales_id` DESC";
    $each_sales_id_query = $connect_db->query($each_sales_id_stmt);
    $get_sales_order_uniqueid = $each_sales_id_query->fetch_assoc();
    $last_sales_order_id = $get_sales_order_uniqueid['each_sales_id'];
    $last_sales_order_number = $get_sales_order_uniqueid['sales_id_number'];
    ## get current year to append to receipt number
    $year = date('y');

    ## Check if Sales Order Exists
    if(empty($last_sales_order_id))
    {
        ## Set New Order / Transaction Number
        $last_sales_order_number = $year. "0001"; 
    }else{
        ## display the record as new invoice or order number 
        ## Increment Order Number by 1 for current or new transaction
        $order_number = $last_sales_order_number + 1;
        $last_sales_order_number = $year. $order_number ;
        // $last_sales_order_number += 1;
    }

 // --- Query 1  End ------


 ## 2 = Get List of Medicinces < Products >
 // -- Query 2 Start --- 
    $products_array = [];

    $get_products = mysqli_query($connect_db,"SELECT * FROM `product` ORDER BY `name` ASC")or die(mysqli_error($connect_db));
    
    while ($each_product = mysqli_fetch_array($get_products)) { 
    $product_id = $each_product['id'];
    $product_code = $each_product['code'];
    $product_name = $each_product['name'];
    
    $products_array += [$product_code=>$product_name]; 

    }
// --- Query 2 End --


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

</style>
</head>
<body>

<!-- ========================= SECTION INTRO START ========================= -->



<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y" >
    <div class="container">

        <!-- Right Bar Start <For Price List View> -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right mb-0">
                    <i class="mdi mdi-close"></i>
                </a>
                <h5 class="m-0 text-white">Medicine Price List</h5>
               
            </div>

            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 568px; ">
                <div class="slimscroll-menu" style="overflow: hidden; width: auto; height: 568px;">
                    <div class="d-flex justify-content-center ">
                        <form class="app-search mt-1">
                            <div class="app-search-box ">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit">
                                            <i class="fe-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    
                    <!-- Settings -->
                    <hr class="mt-0">
                    

                <div class="p-3">
                    
                    <ul class="list-menu">
                        <?php 

                        // //get various categories
                        // $get_categories = mysqli_query($connect_db,"SELECT * FROM `categories_tbl`")or die(mysqli_error($connect_db));
                                                    
                        //     while ($each_category = mysqli_fetch_array($get_categories)) { 
                        //     $category_id = $each_category['category_id'];
                        //     $category_name = $each_category['category_name'];

                        //     $get_total_products = mysqli_query($connect_db,"SELECT * FROM tbl_products WHERE product_category = '$category_id'")or die(mysql_error($connect_db));

                        //     $count_total_products = mysqli_num_rows($get_total_products);
                            
                        ?>
                                <li class="d-flex item-category" id="<?php //echo $category_id ?>"><span><p><?php echo ucwords($category_name)  ?></p></span> <span class="ml-auto"><?php echo $count_total_products; ?></span> </li>
                        <?php //}  ?>
                        
			
				</ul>
                 
                </div> <!-- end .p-3-->

            </div>
            <div class="slimScrollBar" style="background: rgb(158, 165, 171); width: 8px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 901px;"></div>
            <div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
            </div> <!-- end slimscroll-menu-->
        </div>

        <input type="hidden" value="<?php  echo $_COOKIE['u_i']; ?>" name="client-id" id="client-id" />   

        <!-- ============ Choose Medicine & Add to Cart Section Start ============== -->
        <!-- <div class="row justify-content-center bg-light mt-5 mb-0"> -->
        <div class="row justify-content-center mt-5 mb-0">
            
            <div class="col-md-8 mt-2">
                    <form action="" method="post" name="addform">
                        <div class="row">
                               
                                <div class="col-md-9 pt-1 d-none">
                                    <!-- select drugs name <old> -->
                                    <select class="form-control drug-name select-custom mb-0" name="drugName" id="drugName_1" required>
                                        <option class="default-selection " style="display: none;" value="" selected disabled hidden>Select Drug or Medicine Name</option>
                                        <?php
                                            // query db to get all list of drugs, for user selection
                                            $get_all_drugs = mysqli_query($connect_db,"SELECT * FROM `product` ORDER BY `name` ASC")or die(mysqli_error($connect_db));
                                            while ($drugs_list = mysqli_fetch_array($get_all_drugs)) {  ?>
                                            <option value="<?php echo $drugs_list['id']; ?>"><?php echo $drugs_list['code'];?> - <?php echo $drugs_list['name']; ?> | Gh¢: <?php echo $drugs_list['price']; ?></option>
                                            <?php 
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-9">
                                    <!-- select drugs name <old> -->
                                    <input type="text" autocomplete="off"  class="form-control products typeahead border-dark" name="drug-name[]" id="drug-name" required>
                                </div>

                                <div class="col-md-2">
                                    <input type="number" value="1" min="1" name="quantity[]" id="quantity" class="form-control text-dark text-center border-secondary">
                                </div>                                 
     
                            <!-- ===== Display Drug Details As User Choose Unique Drug Item from the dropdown option ===== -->
                            <!-- to be used to display drug price for each selected item from the dropdown, if value id change by user  -->
                            <div class="row drug-cart-holder d-none" id="drugs-holder">
                                <input type="text" name="price[]" id="price" readonly class="form-control price" autocomplete="off">
                                <input type="text" name="name[]" id="name" readonly class="form-control name" autocomplete="off">
                                <input type="text" name="code[]" id="code" readonly class="form-control code" autocomplete="off">
                                <input type="text" name="drug_id[[]" id="id" readonly class="form-control id" autocomplete="off">
                            </div>
                            <!-- ===== Display Drug Details As User Choose Unique Drug Item from the dropdown option ===== -->

                                <div class="col-md-1">
                                    <button class="btn btn-success add-to-cart" data-style="slide-up" type="submit" name="addcart" id="add-to-cart" ><i class="fe-plus font-weight-bold "></i> </button>
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
                    
                        <article class="card mt-2" style="border: 1px solid #5089DE;">
                            <header class="card-header bg-dark d-none">
                                <strong class="d-inline-block mr-3 text-dark float-right">Receipt #: <span class="text-white font-weight-light ml-1" style="letter-spacing: 1px;"> <?php echo $last_sales_order_number; ?></span></strong>
                            </header>
                    
                            <div class="table-responsive" id="cart-info-details">
                            
                                <table class="table table-hover tbl-products">
                                    <thead class="bg-dark text-white text-center ">
                                        <tr style="font-weight:bold">
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

                                <input type="hidden" name="sales_id" id="sales_id" value="<?php echo $last_sales_order_number; ?>"/>
                                
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

                                <div class="row mb-2">
                                    <div class="col-md-4 ">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"> Grand Total: <?php //echo $currency; ?></div>
                                            </div>
                                            <input value="" readonly type="text" class="form-control text-right text-dark " name="grandTotal" id="grandTotal" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"> Balance: <?php //echo $currency; ?></div>
                                            </div>
                                            <input value="" readonly type="text" class="form-control text-right text-dark " name="balance" id="balance" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control text-center text-purple font-weight-bold border-dark" name="amountPaid" autocomplete="off" id="amountPaid" type="text" min="1" maxLength="8" onkeypress="return isNumberKey(event)" placeholder="Amount Paid"/>
                                    </div>
                                </div>

                                
                                <!-- Amount Due for Payable -->
                                <div class="my-2 text-center">
                                    <input type="text" class="custom-input text-danger font-weight-bold" name="amountDue" id="amountDue" readonly value="0" style="text-align: center !important; font-size:20px">
                                </div>

                               <!-- Action Buttons -->
                                <div class="row ">
                                    <div class="col-md-6">
                                        <button type="button" id="pay-only" class="btn btn-success w-100 my-2 font-weight-bold" style="letter-spacing: 1px;"> Pay Only </button>
                                    </div> 
                                    <div class="col-md-6">
                                        <button type="submit" id="pay-print" class="btn btn-primary w-100 my-2 font-weight-bold" style="letter-spacing: 1px;"> <i class="mdi mdi-printer"></i> Pay + Print </button>
                                    </div>
                                </div>
                                
                            </div>
                        </article>
                        
                    </form>
            </aside>
        </div> 
        <!-- ========================= Pay Section End  //  ========================= -->
            
            
        <!-- Empty Cart -->
        <div class="row justify-content-center d-nonee">
            <div class="col-md-8 mt-2">
                <button type="button" id="clear-all" class="btn btn-danger d-nonee w-100 my-2 font-weight-bold" style="letter-spacing: 1px;"> Clear All </button>
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


    /* Type  Ahead Start */
    // constructs the suggestion engine
        var states = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // `states` is an array of state names defined in "The Basics"
        local: ['<?php echo implode("', '", $products_array) ?> ']
    });

    $('.typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'states',
        source: states
    });


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

    function initiateBloodHound(){
        //    var states = new Bloodhound({
        //     datumTokenizer: Bloodhound.tokenizers.whitespace,
        //     queryTokenizer: Bloodhound.tokenizers.whitespace,
        //     // `states` is an array of state names defined in "The Basics"
        //     local: ['<?php echo implode("', '", $products_array) ?> ']
        // });

        // $('.typeahead').typeahead({
        //     hint: true,
        //     highlight: true,
        //     minLength: 1
        // }, {
        //     name: 'states',
        //     source: states
        // });

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
    
    //logout button click function
    $(document).on('click', '#logout', function(e){
        $('#logout-modal').modal('show');
    }) 

    // update password button click event
    $('#update-password').on('click',function(){
        $('#update-password-modal').modal('show');
    }) 

    // get users sales for the day - ie Today
    $('#my-sales').on('click',function(e){
      
        e.preventDefault();
        var my_id = $('#client-id').val();
        $.ajax({
            url: 'api_calls/sales_api/get-my-sales.php',
            type: 'POST',
             data: 'id=' + my_id,
            success: function(res) {
                $('#my-sales-tbody').html(res);
                 $('#sales-modal').modal('show');
            },
            error: function() {}
        })
    })

    // trigger to update users password
    $(document).on('submit', '#update-password-form', function(e) {
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajax({
            url: 'api_calls/profile_api/update-client-password.php',
            type: 'POST',
            data: formdata,
            success: function(res) {
                if (res === 'success') {
                  Swal.fire(
                        'Success',
                        'Password updated..! Kindly login again with your new password',
                        'success').then(function(){
                            window.location.href='logout.php'
                        })
                }else if(res=== 'unauthorized'){
                     Swal.fire(
                        'Error',
                        'Unauthorized..! Kindly login',
                        'error').then(function(){
                            window.location.href='logout.php'
                        })
                }else if (res === 'error'){
                      Swal.fire(
                        'Error',
                        'Error..! Kindly check your current password and try again',
                        'error')
                }else{
                     Swal.fire(
                        'Error',
                        'Error..! Kindly check your current password and try again',
                        'error')
                }
            },
            error: function() {}
        })

    })

    // select drug onchange function : get unique drug info when the user select durg-name
    $(document).on('change', '.drug-name', function() {
        var id = $(this).attr('id');
        var productId = $(this).val();

        var idNumber = id.substr(12);

            $.ajax({
            // url: 'api_calls/sales_api/fetch-product-details.php',
            url: 'api_calls/sales_api/fetch.drug.details.php',
            type: 'POST',
            data: 'productId=' + productId,
            success: function(res) {
                $('#price').val(res.price);
                $('#name').val(res.name);
                $('#drug_id' ).val(res.id);
                $('#code' ).val(res.code);
                $('#drug_id' ).val(res.code);
                allowAddBtn();
            },
            error: function() {}
        })
    })

    // triggers to add the drug-details to cart
    $("#add-to-cart").on("click", function(){
        // check if medicine or drug name has been selected by user
        if(document.addform.drugName.value == "")
        {
            $.toast({
            heading: "Error",
            text: "Select valid drug or medicine name from the list below",
            position: "top-center",
            loaderBg: "#BF441D",
            icon: "error",
            stack: "1"
            });
            document.addform.drugName.focus();
            return false;
        }else{
            // get drugs info
            var drug_id = $("#drug_id").val();
            var price = $("#price").val();
            var name = $("#name").val();
            var quantity = $("#quantity").val();
            var total = quantity * price;
        
            // Add & Show Cart-Details for printable
            addDrugToCart(name,price,quantity,total,drug_id);   // add drug to cart
            $(".select-custom").val(null).trigger("change");  //reset dropdown
            $(this).prop("disabled", true);
        }
       
    })

  
    $(document).on('click', '.removeRows', function() {
            $(this).closest('tr').remove();
             calculateTotal();
    });


    $(document).on('submit', '#pos-form', function(e) {
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajax({
            url: 'api_calls/sales_api/record-sales-original.php',
            type: 'POST',
            data: formdata,
            success: function(res) {
                if (res === 'success') {
                    
            var new_location = "sales-print.php?sid=" + $('#sales_id').val();
            window.location.href = new_location;
                    
                } else if (res === 'less') {
                    Swal.fire(
                        'Error',
                        'Amount Entered Is Less Than Total Amount',
                        'error')
                } else if (res === 'more') {
                    Swal.fire(
                        'Error',
                        'Amount Entered Is Greater Than Total Amount',
                        'error')
                } else if (res === 'less_product') {
                    Swal.fire(
                        'Error',
                        'Quantity Entered Must Be Less Than Available Product',
                        'error')
                } else if (res === 'select') {
                    Swal.fire(
                        'Error',
                        'Please Select At Least One Product And Enter Amount Paid',
                        'error')
                }
            },
            error: function() {}
        })

    })


    $(document).on('blur', "[id^=quantity_]", function() {
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

function addDrugToCart(productName,unitPrice,quantity,total,product_id){
    var htmlRows = '';
    htmlRows += '<tr>';
    htmlRows +=
    '<td><input type="text" readonly required="required" name="name[]" id="name_' +
    count + '" class="form-control available" autocomplete="off" value="'+productName+'"><input type="hidden" readonly name="product_id[]" id="product_id_' +
    count + '" class="form-control available" autocomplete="off" value="'+product_id+'"></td>';


    htmlRows +=
    '<td><input type="number" readonly required="required" name="price[]" id="price_' +
    count + '" class="form-control available text-right" autocomplete="off" value="'+unitPrice+'"></td>';

    htmlRows +=
    '<td><input type="number" required="required" name="quantity[]" id="quantity_' +
    count + '"  class="form-control available text-center" autocomplete="off" value="'+quantity+'"></td>';

    htmlRows +=
    '<td><input type="number" readonly required="required" name="total[]" id="total_' +
    count + '" class="form-control available text-right" autocomplete="off" value="'+total+'"></td>';

    htmlRows +=
    '<td width="5"> <a href="#" class="btn btn-outline-danger removeRows">x</a></td>';

     htmlRows += '</tr>';

    $('.tbl-products').append(htmlRows);

    calculateTotal();

    count++
}


// function to get departments list
function getDrugRow(id){
  $.ajax({
    type: 'POST',
    url: 'api_calls/sales_api/fetch.drug.details.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.did);
      $('#edit_deptname').val(response.dept_name);
      $('#edit_desc').val(response.description);
      $('#edit_desc').html(response.description);
      $('.fullname').html(response.dept_name);
      $('#desc').html(response.description);
    }
  });
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
          $('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
        }else{
          $('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
        }
      }
    })
</script>
</body>
</html>