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
$get_minimum_expire_alert = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 8") or die(mysqli_error($connect_db));
$get_minimum_item = mysqli_fetch_array($get_minimum_expire_alert);
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
    
                            <ol class="breadcrumb m-0" style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item active"> Medicines Expiry Alerts</li>
                            </ol> 
                          
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Expiry Alerts </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box">
                       
                            <table class="table table-sm table-hover m-0 table-centered nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;" >
                                        <th class="font-weight-bold">No</th>
                                        <th class="font-weight-bold">Medicine Name</th>
                                        <th class="font-weight-bold">Cost Price </th>
                                        <th class="font-weight-bold">Selling Price </th>
                                        <th class="font-weight-bold">Days Remaining </th>
                                        <th class="font-weight-bold"> Expiry Date</th>
                                    </tr>
                                </thead>

                                 <tbody id="fetch-products">
                                <?php
                                        $counter = 1;
                                        $sql_expiry_alert = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` ORDER BY mid ASC")or die(mysqli_error($connect_db));
                                        while($alert_info = mysqli_fetch_array($sql_expiry_alert)){  
                                        $get_product_id = $alert_info['mid'];
                                        $get_product_name = $alert_info['medicine_name'];

                                        $get_batch_no = $alert_info['medicine_code'];
                                        $get_selling_price = $alert_info['selling_price'];
                                        $get_cost_price = $alert_info['cost_price'];
                                        $get_expiry= $alert_info['medicine_expiry_date'];
                                            
                                            $get_current_date = date_create(date("d-M-Y"));
                                            $check_expire = date_create(date('d-M-Y', strtotime($get_expiry))); 
                                            $interval = date_diff( $get_current_date, $check_expire);

                                            $remaining_days = intval($interval->format('%R%a'));
                                            $months_remaining = $interval->format('%m months remaining');
                                            
                                            ?>
                                <?php
                                            if ($months_remaining <= $minimum && $remaining_days > 0) {  ?>
                                <tr>
                                    <td><b><?php echo $counter;   ?></b></td>
                                    <td>
                                        <span><?php echo $get_product_name;?></span>
                                    </td>

                                    <td >
                                        <?php echo $currency.' '.$get_cost_price;   ?>
                                    </td>

                                    <td>
                                        <?php echo $currency.' '.$get_selling_price;   ?>
                                    </td>                                   

                                    <td class="text-primary">
                                        <?php if($remaining_days < 0){  ?>
                                        <?php //echo '';   ?>
                                        <?php  }else{  ?>
                                        <?php echo $remaining_days." days remaining"; ?>
                                        <?php } ?>
                                    </td>
                                   

                                    <td>
                                        <?php echo date('d-M-Y', strtotime($get_expiry));   ?>
                                    </td>
                                    
                                </tr>
                                <?php  $counter++;  }
                             }  ?>
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