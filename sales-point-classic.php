<?php 
    require_once 'header/client-header.php'; 

    $sales_id = mt_rand(10000,90000000);


    ## Get the last Sales Order ID from db
    require_once('db/db.php');
    $each_sales_id_stmt = "SELECT * FROM `tbl_each_sales` ORDER BY `each_sales_id` DESC";
	$each_sales_id_query = $connect_db->query($each_sales_id_stmt);
	$get_sales_order_uniqueid = $each_sales_id_query->fetch_assoc();
    $last_sales_order_id = $get_sales_order_uniqueid['each_sales_id'];
    $last_sales_order_number = $get_sales_order_uniqueid['sales_id_number'];

    ## Check if Sales Order Exists
    if(empty($last_sales_order_id))
    {
        ## Set New Order / Transaction Number
        $current_order_number = "00001"; 
    }else{
        ## display the record as new invoice or order number 
        ## Increment Order Number by 1 for current or new transaction
        $last_sales_order_number += 1;
    }
?>


<style type="text/css">

    /* body styling */
    body{
        /* background-image: linear-gradient(to bottom right, red, yellow); */
        /* background-color: #1a82f7; */
        /* background: url(images/linear_bg_2.png); */
        /* background-repeat: repeat-x; */

        /* Safari 4-5, Chrome 1-9 */
        /* background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#1a82f7), to(#2F2727)); */

        /* Safari 5.1, Chrome 10+ */
        /* background: -webkit-linear-gradient(top, #2F2727, #1a82f7); */

        /* Firefox 3.6+ */
        /* background: -moz-linear-gradient(top, #2F2727, #1a82f7); */

        /* IE 10 */
        /* background: -ms-linear-gradient(top, #2F2727, #1a82f7); */

        /* Opera 11.10+ */
        /* background: -o-linear-gradient(top, #2F2727, #1a82f7); */

    }
    .custom-input{
        text-align: right !important;
        border: none !important;
    }

    /* animated search button */
    input[type=text] {
        width: 70px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    /* When the input field gets focus, change its width to 100% */
    input[type=text]:focus {
        width: 50%;
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

    <div class="preloader"></div>

<!-- timer/clock script -->
<script language="javascript" type="text/javascript">
    /* Visit http://www.yaldex.com/ for full source code
    and get more free JavaScript, CSS and DHTML scripts! */

    var timerID = null;
    var timerRunning = false;
    
    // stop clock
    function stopclock (){
        if(timerRunning)
        clearTimeout(timerID);
        timerRunning = false;
    }
    
    // show time
    function showtime () {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds()
        var timeValue = "" + ((hours >12) ? hours -12 :hours)
        if (timeValue == "0") timeValue = 12;
        timeValue += ((minutes < 10) ? ":0" : ":") + minutes
        timeValue += ((seconds < 10) ? ":0" : ":") + seconds
        timeValue += (hours >= 12) ? " P.M." : " A.M."
        document.clock.face.value = timeValue;
        timerID = setTimeout("showtime()",1000);
        timerRunning = true;
    }

    // start clock
    function startclock() {
        stopclock();
        showtime();
    }

    //ajax loader
    function ajaxloader(){
        $('.preloader').show();
        setTimeout(function(){
            $('.preloader').fadeToggle();
            startclock();
        }, 300)
    }

   
    window.onload=ajaxloader;
    // window.onload=startclock;

</script>

<!-- ========================= SECTION INTRO END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">



 <input type="hidden" value="<?php  echo $_COOKIE['u_i']; ?>" name="client-id" id="client-id" />
        <!-- Start Content-->
 
            <!-- start page title -->
            <div class="row bg-white" style="border-bottom: 3px solid #14324d;">
                <div class="col-12 mb-1">
                    <div class="page-title-box d-flex align-items-center justify-content-center">
                        <img src="assets/images/main-logo.svg" class="ml-1" alt="PharmSolv" height="50" width="120">
                    
                        <?php	
                            $Today = date('y:m:d',mktime());
                            $new = date('l, F d, Y', strtotime($Today));
						?>
                        <div class="hero-unit-clock text-right mt-0" style="font-size: 14px;">
                            <form name="clock">
                                <label for="date" class="control-label text-purple font-weight-bold mr-1">Date: </label> <?php echo $new ?>
                                <label for="time" class="control-label text-purple font-weight-bold ml-2">Time: </label> <input type="text" style="width: 100px;" class="trans border-secondary bg-white mr-3" name="face" value="" onclick="" readonly>
                                <label for="displayname" style="font-size: 14px" class="page-title text-dark font-weight-lighter ml-2">Hi, <?php echo ucwords($_COOKIE['f_name']) ?>!</label>
                            </form>
                        </div>
                    <div>
                        <!-- display users name -->
                        <!-- <label for="displayname" style="font-size: 14px" class="page-title text-secondary font-weight-lighter ml-4">Welcome, <?php echo ucwords($_COOKIE['f_name']) ?>!</label> -->
                        <!-- <h4 class="page-title font-weight-lighter ml-4">Welcome <span class="text-capitalize"><?php  echo $_COOKIE['f_name']; ?></span>,</h4> -->
                    </div>

                    
                    <div class="ml-auto page-title">

                    
                            <!-- <button class="btn btn-md btn-primary mr-0 search" id="search_btn" data-toggle="modal" data-target="#search"> <i class="fa fa-search"> </i></button> -->
                             <button class="btn btn-md btn-outline-warning mr-0 order-food" id="switch_original"><i class="mdi mdi-sync" ></i> Switch To Orginal View </button>
                            <button class="btn btn-md btn-outline-success mr-0 my-sales"><i class="mdi mdi-finance"></i> My Sales</button>
                            <button class="btn btn-md btn-outline-info mr-1 update_password" id="update_password"> <i class="mdi mdi-key-change"></i> Change Password</button>
                            <button class="btn btn-md btn-outline-danger " id="logout"> <i class="mdi mdi-logout"></i>Logout</button>
 
                    </div>

      
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <!-- <div class="visible-xs navbar-form navbar-right" style="display: none;">
                <input type="text" name="search" class="search form-control" placeholder="Search" >
            </div> -->




<div class="row">

<!-- ========================= Categories Section Start  ========================= -->

	<aside class="col-md-2">
<div class="card mt-1" style="border: 1px solid #14234d;">
	<article class="filter-group">
		<header class="card-header bg-info ">
			
				<h5 class="title text-white">Categories List</h5>
		</header>
		<div class="filter-content collapse show" id="collapse_1" style="">
			<div class="card-body text-dark">
				
				<ul class="list-menu">
                <?php 

                //get various categories
                $get_categories = mysqli_query($connect_db,"SELECT * FROM `categories_tbl`")or die(mysqli_error($connect_db));
                                            
                    while ($each_category = mysqli_fetch_array($get_categories)) { 
                    $category_id = $each_category['category_id'];
                    $category_name = $each_category['category_name'];

                    $get_total_products = mysqli_query($connect_db,"SELECT * FROM tbl_products WHERE product_category = '$category_id'")or die(mysql_error($connect_db));

                    $count_total_products = mysqli_num_rows($get_total_products);
                    
                   ?>
                        <li class="d-flex item-category" id="<?php echo $category_id ?>"><span><?php echo ucwords($category_name)  ?></span> <span class="ml-auto"><?php echo $count_total_products; ?></span></li>
                <?php }  ?>
				
			
				</ul>

			</div> <!-- card-body.// -->
		</div>
	</article> <!-- filter-group  .// -->
</div> <!-- card.// -->


<div class="card">
	<!-- <div id="wrapper">
  <div id="app"></div>
</div> -->
</div> <!-- card.// -->

</aside> <!-- col.// -->


<!-- ========================= Categories Section End //  ========================= -->




<!-- ========================= Products Section Section Start  ========================= -->
<main class="col-md-6 bg-white mt-1 d-none" style="border: 1px solid #56c2d6; background: -webkit-linear-gradient(top, #48c6ef, #1a82f7); background: -moz-linear-gradient(top, #48c6ef, #1a82f7);">
<div class="row products-holder mt-2 ">
</div> <!-- row end.// -->
</main> <!-- col.// -->
<!-- ========================= Products Section End //  ========================= -->



<!-- ========================= Pay Section Section Start  ========================= -->
<aside class="col-md-4">
    <form id="pos-form" method="post">		
        <article class="card mt-1" style="border: 1px solid #14234d;">
            <header class="card-header bg-info">
                <!-- <strong class="d-inline-block mr-3 text-dark">Order ID: <span class="text-white font-weight-light ml-1" style="letter-spacing: 0.5px;"> <?php //echo $sales_id; ?></span></strong> -->
                <strong class="d-inline-block mr-3 text-dark pull-right">Order No: <span class="text-white font-weight-bold ml-1" style="letter-spacing: 0.5px;"> <?php echo $last_sales_order_number; ?></span></strong>
            </header>
	
            <div class="table-responsive">
            <table class="table table-hover tbl-products">
                <thead class="">
                    <tr style="font-weight:bold">
                        <td width="30%">Product</td>
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

            <div class="pt-3 mx-2 mb-2 border-top " >

        
				
				<dl class="dlist-align">
				  <dt>Subtotal:</dt>
				  <dd class="text-right"><input type="text" class="custom-input" readonly name="subTotal" id="subTotal"></dd>
                  
				</dl>
				<dl class="dlist-align">
				  <dt>Discount:</dt>
				  <dd class="text-right text-danger"><input class="custom-input" type="text" readonly name="discountTotal" id="discountTotal" value="0"></dd>
                  
				</dl>
				<dl class="dlist-align">
				  <dt>Grand Total:</dt>
				  <dd class="text-right text-dark"> <input class="custom-input totalAftertax" type="text" readonly name="totalAftertax" ></dd>
                 
				</dl>
				<hr>
                <input type="hidden" name="sales_id" id="sales_id" value="<?php echo $last_sales_order_number; ?>"/>
                <div class="row mb-2">
                    <div class="col-md-6 ">
                        <input class="form-control border-dark" name="taxRate" autocomplete="off" id="taxRate" type="number" placeholder="Tax Allowed"/>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control border-dark" name="discountRate" autocomplete="off" id="discountRate" type="number" placeholder="Discount Allowed"/>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control border-dark" name="taxAmount" type="hidden" placeholder="Tax Allowed"/>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control border-dark" name="discountAmount" type="hidden" placeholder="Tax Allowed"/>
                    </div>
                </div>

                <input type="number" name="amountPaid" class="form-control w-100 my-2 border-dark" id="amountPaid" autocomplete="off" placeholder="Amount Paid"/>

                  <div class="my-2 text-center">
                    <input type="text" class="custom-input text-purple font-weight-bold" name="amountDue" id="amountDue" readonly value="0" style="text-align: center!important; font-size:20px">
                </div>

				<button type="submit" id="print" class="btn btn-success btn-lg btn-block font-weight-light"> <i class="fa fa-print"></i> Pay + Print </button>
                   
			</div>
		</article>
    </form>
</div>


<!-- ========================= Pay Section End  //  ========================= -->

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= FOOTER ========================= -->
<!-- <footer class="section-footer border-top padding-y">
	<div class="container">
		<p class="float-md-right"> 
			&copy Copyright 2019 All rights reserved
		</p>
		<p>
			<a href="#">Terms and conditions</a>
		</p>
	</div>  //container
</footer> -->
<!-- ========================= FOOTER END // ========================= -->


<!-- ======= SEARCH MODAL DIALOG ==== -->
    <div class="modal" tabindex="-1" role="dialog" id="search-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
           
            <div class="modal-body">
                <form action="" method="post">
                <div class="row">
                    <div class="col-md-12">
                       
                        <!-- Another variation with a button -->
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for product..">
                            <div class="input-group-append">
                            <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>

            </div>
        </div>
    </div>
<!-- === SEARCH MODAL DIALOG ENDS ==== -->


<?php require_once 'modals/user_modal.php';   ?>
<?php require_once 'footer/admin-footer.php';   ?>


<script>

$(document).ready(function(){


    $('#switch_original').click(function(){
        // set the item in localStorage
        localStorage.setItem('view', 'original');
        window.location.href='sales-point-original.php';
    })
    
        //logout button click function
    $(document).on('click', '#logout', function(e){
        $('#logout-modal').modal('show');
    }) 

    $('#search_btn').on('click', function(){
        $('#search-modal').modal('show');
    })

    // update password button click event
    $('#update_password').on('click',function(){
        $('#update-password-modal').modal('show');
    }) 

     $('.my-sales').on('click',function(e){
      
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

  

   $('.item-category').click(function(){
       var category_id = $(this).attr('id');
       //get all products pertaining to this category
        $.ajax({
            url: 'api_calls/products_api/load-product-by-category.php',
            type: 'POST',
            data: 'category_id=' + category_id,
            success: function(res) {
                $('.products-holder').html(res);
            },
             error: function(res) {
                    console.log(res);
                }
        })
   })

    $(document).on('click','.card-product-grid',function(){
        var product_id = $(this).attr('id');

     $.ajax({
            url: 'api_calls/products_api/load-product-details.php',
            type: 'POST',
            data: 'product_id=' + product_id,
            success: function(res) {
                var total_amount = res.product_selling_pcs * 1;
               addNewProduct(res.product_name,res.product_selling_pcs,1,total_amount,product_id)
            },
             error: function(res) {
                    console.log(res);
                }
        })
   })


    $(document).on('click', '.removeRows', function() {
            $(this).closest('tr').remove();
             calculateTotal();
    });


    $(document).on('submit', '#pos-form', function(e) {
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajax({
            url: 'api_calls/sales_api/record-sales-classic.php',
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
    $(document).on('blur', "#amountPaid", function() {
        var amountPaid = $(this).val();
        var totalAftertax = $('.totalAftertax').val();
        console.log(totalAftertax);
        if (amountPaid && totalAftertax) {
            totalAftertax = totalAftertax - amountPaid;
            $('#amountDue').val((totalAftertax.toFixed(2)));
        } else {
            $('#amountDue').val((totalAftertax.toFixed(2)));
        }
    });


})


 var count  = 0; 
function addNewProduct(productName,unitPrice,quantity,total,product_id){
        var htmlRows = '';
    htmlRows += '<tr>';
    htmlRows +=
    '<td><input type="text" readonly required="required" name="product_name[]" id="product_name_' +
    count + '" class="form-control available w-100" autocomplete="off" value="'+productName+'"><input type="hidden" readonly name="product_id[]" id="product_id_' +
    count + '" class="form-control available" autocomplete="off" value="'+product_id+'"></td>';


    htmlRows +=
    '<td><input type="text" readonly required="required" name="price[]" id="price_' +
    count + '" class="form-control available" autocomplete="off" value="'+unitPrice+'"></td>';

    htmlRows +=
    '<td><input type="number" required="required" name="quantity[]" id="quantity_' +
    count + '"  class="form-control available" autocomplete="off" value="'+quantity+'"></td>';

    htmlRows +=
    '<td><input type="text" readonly required="required" name="total[]" id="total_' +
    count + '" class="form-control available" autocomplete="off" value="'+total+'"></td>';

    htmlRows +=
    '<td> <a href="#" class="btn btn-outline-danger removeRows">x</a></td>';

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
</script>

</body>
</html>