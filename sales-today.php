<?php  

require_once 'session.php'; 


require_once 'db/db.php'; 
require_once 'template/header.admin.php'; 
require_once 'template/topnav.admin.php'; 
require_once 'template/menu.admin.php'; 


## Query 3 - Get Currency
$sql_currency = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '7'")or die(mysql_error($connect_db));
$currency = mysqli_fetch_assoc($sql_currency);
$currency_value = $currency['settings_ans'];

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
                           
                            <a href="sales.list.php">
                                <button type="button" class="btn btn-primary btn-md waves-effect waves-light float-right ml-2" id="add-staff">
                               <i class="mdi mdi-finance"></i> All-Time Sales
                                </button> 
                            </a>
                            
                            <a href="sales-yesterday.php">
                                <button type="button" class="btn btn-outline-dark btn-md waves-effect waves-light float-right ml-3" id="add-staff">
                               <i class="mdi mdi-finance"></i> Get Yesterday's Sales
                                </button>
                            </a>                      
                            <ol class="breadcrumb m-0 d-none" style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Sales</a></li>
                                <li class="breadcrumb-item active"> Sales Today</li>
                            </ol> 
                          
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Today's Sales</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box">
                       
                            <table class="table table-bordered table-hover m-0 table-centered nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;" class="text-center">
                                        <th>No</th>
                                        <th>Medicine Name</th>
                                        <th>Price </th>
                                        <th>Quantity </th>
                                        <th>Total </th>
                                        <th>Date Time</th>
                                        <th>Sales Served By</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $counter = 1;
                                        $sql_get_each_sale = "SELECT * FROM `tbl_special_sales` WHERE YEAR(sales_datetime) = YEAR(NOW()) AND MONTH(sales_datetime) = MONTH(NOW()) AND DAY(sales_datetime) = DAY(NOW())";
                                        $run_query = $connect_db->query($sql_get_each_sale);
                                        if(!empty($run_query)){
                                        while($each_sales_row = $run_query->fetch_assoc()){
                                            $each_sale_id_number = $each_sales_row['sales_number'];
                                            $each_sale_sub_total = $each_sales_row['sales_subtotal'];
                                            $each_sale_total = $each_sales_row['sales_total'];
                                            $each_sale_amountpaid = $each_sales_row['amount_paid'];
                                            $each_sale_timestamp = strtotime($each_sales_row['sales_datetime']);
                                            $each_sale_seller = $each_sales_row['sales_seller_id'];
                                            $timestamp = date('d-M-Y H:i:s a', $each_sale_timestamp);


                                            // Get Records from Medicines Sold
                                            $sql_get_sales = "SELECT * FROM `tbl_sales` WHERE `sales_id_number`='$each_sale_id_number' ";
                                            $fetch_all_sales = $connect_db->query($sql_get_sales);
                                            while($sale_record = $fetch_all_sales->fetch_array())
                                            {
                                                $medicine_id = $sale_record['medicineId'];
                                                $medicine_price = $sale_record['medicinePrice'];
                                                $medicine_total = $sale_record['medicineTotal'];
                                                $medicine_quantity = $sale_record['medicineQty'];
                                                $medicine_qty_type = $sale_record['quantity_type']; // Quantity Type Sold : Not Used Now

                                                // Bind Data to Get Full Medicines Details
                                                $sql_get_medicine = "SELECT * FROM `tbl_medicines` WHERE `mid`='$medicine_id'";
                                                $query_read_medicine_details = $connect_db->query($sql_get_medicine);
                                                $medicineInfo = $query_read_medicine_details->fetch_assoc();
                                                $nameOfMedicine = $medicineInfo['medicine_name'];
                                                $sellingPriceOfMedicine = $medicineInfo['selling_price'];

                                                // Get Name of Staff Who Recorded OR Served The Sale
                                                $sql = "SELECT `user_firstname`,`user_lastname` FROM `tbl_users` WHERE `uid`='$each_sale_seller'";
                                                $runQuery = $connect_db->query($sql);
                                                $readInfo = $runQuery->fetch_assoc();
                                                $salesRecorder = $readInfo['user_firstname'].' '.$readInfo['user_lastname'];

                                                ## ----- End Fetching Of Records ------

                                                ## ----- Display Records/Details Into Table For Client/User View
                                                ?>
                                                <tr>
                                                    <td> <?php echo $counter; ?> </td>
                                                    <td> <?php echo $nameOfMedicine; ?> </td>
                                                    <td> <?php echo $currency_value. " ".$sellingPriceOfMedicine; ?> </td>
                                                    <td> <?php echo $medicine_quantity; ?> </td>
                                                    <td> <?php echo $currency_value. " ".$medicine_total; ?> </td>
                                                    <td> <?php echo $timestamp; ?> </td>
                                                    <td> <?php echo $salesRecorder; ?> </td> 
                                                </tr>
                                                <?php 
                                                $counter++;
                                            }

                                        }
                                    }

                                    ?>
                                
                                </tbody>

                            </table>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->


    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {
        // fetchGenericList(); /* it will load products when document loads */
       

        $('#add-new-generic').click(function(e) {
            $('#generic-modal').modal('show');
              $("#generic_id").attr("data-id", "add");
        });

        // saves new generic
        $('#generic-form').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

                $.ajax({
                    url: 'api_calls/general_api/add.generic.php',
                    type: 'POST',
                    data: formdata,
                    success: function(res) {
                        $.toast({
                            heading: "Success",
                            text: "Generic name added successfully",
                            position: "top-right",
                            loaderBg: "#5ba035",
                            icon: "success",
                            stack: "4"
                        });
                        fetchGenericList();
                        $('#generic-modal').modal('hide');
                        $('#name').val('');
                        $('#description').val('');
                    },
                    error: function(res) {
                        console.log(res);  
                        $.toast({
                            heading: "Error",
                            text: "Sorry, something went wrong while adding the record",
                            position: "top-right",
                            loaderBg: "#bf441d",
                            icon: "error",
                            stack: "4"
                        });
                    }
            });
        });

        // updates the generic
        $('#edit-generic-form').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

            $.ajax({
                url: 'api_calls/general_api/edit.generic.php',
                type: 'POST',
                data: formdata,
                success: function(res) {
                    $.toast({
                        heading: "Success",
                        text: "Changes has been saved",
                        position: "top-right",
                        loaderBg: "#5ba035",
                        icon: "success",
                        stack: "4"
                    });
                    fetchGenericList();
                    $('#edit-modal').modal('hide');
                    $('#genericid').val('');
                    $('#generic_name').val('');
                    $('#generic_description').val('');

                },
                error: function(res) {
                    console.log(res);
                    $.toast({
                        heading: "Error",
                        text: "Oooops...  Process request error, unable to update",
                        position: "top-right",
                        loaderBg: "bf441d",
                        icon: "error",
                        stack: "4"
                    });
                }

            });

        })

        // triggers edit button click
        $(document).on('click', '.edit-button', function(e) {
            var categoryId = $(this).data('id');
            $("#genericid").val(categoryId);
            $("#generic_id").attr("data-id", "edit");
                $.ajax({
                    url: 'api_calls/general_api/generic.details.php',
                    type: 'POST',
                    data: 'categoryId=' + categoryId,
                    dataType: 'json',
                    success: function(res) {
                        // $('#cgeneric_id').val(res.mcid);
                        $('#generic_name').val(res.generic_name);
                        $('#generic_description').val(res.generic_description);

                        $('#edit-modal').modal('show');
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
        });

        $(document).on('click', '.delete-button', function(e) {
            e.preventDefault();
            var supplierId = $(this).data('id');
            SwalDelete(supplierId);
            e.preventDefault();
        });

    });

    function fetchGenericList() {
         $('#tickets-table').dataTable({
            paging: true,
            searching: true,
            "bDestroy": true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'api_calls/general_api/fetch.generics.php'
            },
            'columns': [
                {
                    data: 'genericid'
                },
                {
                    data: 'generic_name'
                },
                {
                    data: 'generic_description'
                },
                {
                    data: 'generic_date_created'
                },
                {
                    data: 'action'
                }

            ]
        });
    }

    function SwalDelete(supplierId) {
       swal.fire({
			title: 'Are you sure?',
			text: "It will be deleted permanently!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			     $.ajax({
			   		url: 'api_calls/general_api/delete.generic.php',
			    	type: 'POST',
			       	data: 'delete='+supplierId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal.fire('Deleted!', response.message, response.status);
					fetchGenericList();
			     })
			     .fail(function(){
			     	swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
			     });
			  });
		    },
			allowOutsideClick: false			  
		});	

    }
    </script>