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


    // get minimum expiry alert
$get_minimum_alert = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 6") or die(mysqli_error($connect_db));
$get_minimum_item = mysqli_fetch_array($get_minimum_alert);
$minimum = $get_minimum_item['settings_ans'];

$get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
$get_currency_value = mysqli_fetch_array($get_currency);
$currency = $get_currency_value['settings_ans'];

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
                      
                            <button type="button" class="btn btn-warning btn-md waves-effect waves-light font-weight-bold text-dark float-right ml-3" id="restock-btn">
                             <i class="mdi mdi-cart-plus"></i>  Take New Stocks 
                            </button>

                            <ol class="breadcrumb m-0 " style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Stocks</a></li>
                                <li class="breadcrumb-item active"> Stock Alert</li>
                            </ol> 
                          
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;"> Stock Alert</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box">
                       
                            <table class="table table-sm table-hover m-0 table-centered nowrap w-100" id="tickets-table">
                                <thead >
                                    <tr style="color: #145388;" >
                                        <th class="font-weight-bold">No</th>
                                        <th class="font-weight-bold">Code No </th>
                                        <th class="font-weight-bold">Medicine Name</th>
                                        <th class="font-weight-bold">Category </th>
                                        <th class="font-weight-bold">Qty Left </th>
                                        <th class="font-weight-bold"> </th>
                                    </tr>
                                </thead>

                                 <tbody id="fetch-products">
                                <?php
                                    $counter = 1;
                                    $fetchMedicineInfo = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` JOIN `tbl_temporary_stocks` ON `tbl_medicines`.`mid` = `tbl_temporary_stocks`.`medicine_id` WHERE `tbl_temporary_stocks`.`stock_level` <= '$minimum' ORDER BY `tbl_temporary_stocks`.`stock_level` ASC")or die(mysqli_error($connect_db));
                                    if(!empty($fetchMedicineInfo)):
                                    while($product_info = mysqli_fetch_array($fetchMedicineInfo)){  
                                        $get_product_id = $product_info['mid'];
                                        $get_product_code = $product_info['medicine_code'];
                                        $get_product_name = $product_info['medicine_name'];
                                        $get_product_quantity = $product_info['stock_level'];                                        $get_product_category = $product_info['category_id'];

                                        // get category name 
                                        $get_category = mysqli_query($connect_db,"SELECT * FROM `tbl_medicine_categories` WHERE `mcid`='$get_product_category'")or die(mysqli_error($connect_db));
                                        $cate_data = mysqli_fetch_assoc($get_category);
                                        $medicine_category_name = $cate_data['med_cat_name'];
                                        
                                       
                                    ?>
                                
                                <tr>
                                    <td><b><?php echo $counter;   ?></b></td>
                                     
                                    <td>
                                       <?php echo $get_product_code;?>
                                    </td>

                                    <td>
                                        <?php echo $get_product_name;   ?>
                                    </td>

                                    <td>
                                        <?php echo $medicine_category_name;   ?>
                                    </td>
                                                                    

                                    <td>
                                        <?php if($get_product_quantity !== "0"): ?>
                                        <font class="text-dark"><?php echo $get_product_quantity. " items remaining"; ?></font>
                                        <?php else: ?>
                                        <font class="text-danger"><?php echo "Stock Out"; ?></font>
                                        <?php endif; ?>
                                    </td>

                                    
                                     <td>
                                         <a href="add.stock.php?medicine_id=<?php echo $get_product_id; ?>">
                                        <button type="submit" class="btn btn-info btn-sm font-weight-bold add_stock">Add Stock</button></a>
                                    </td>

                                </tr>
                                <?php  $counter++;  }
                                endif
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
         var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }


        // triggers new button click
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

        $(document).on('click', '#restock-btn', function(e){
            var url = 'stock.entry.php';
            window.location.href = url;
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