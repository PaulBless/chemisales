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
                      
                            <!-- print button  -->
                            <button type="button" class="btn btn-info btn-md waves-effect waves-light font-weight-bold text-white float-right ml-4" id="print">
                             <i class="mdi mdi-printer"></i> Print 
                            </button>
                            
                            <button type="button" class="btn btn-warning btn-md waves-effect waves-light font-weight-bold text-dark float-right ml-4 d-none" id="dispose-all">
                             <i class="mdi mdi-reply"></i>  Dispose All Expired Medicines 
                            </button>

                            <ol class="breadcrumb m-0 " style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item active"> Expired Medicines</li>
                            </ol> 
                          
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Expired Medicines </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box" id="print-doc">

                       <!-- <button type="button" id="print" class="btn btn-sm btn-info float-left"> <i class="mdi mdi-printer"></i> Print</button> -->

                            <table class="table table-sm table-hover m-0 table-centered nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;" >
                                        <th class="font-weight-bold">No</th>
                                        <th class="font-weight-bold">Medicine Name</th>
                                        <th class="font-weight-bold">Cost Price </th>
                                        <th class="font-weight-bold">Selling Price </th>
                                        <th class="font-weight-bold">Status </th>
                                        <th class="font-weight-bold"> Expired Date</th>
                                        <th class="font-weight-bold">Action </th>
                                    </tr>
                                </thead>

                                 <tbody id="fetch-products">
                                <?php
                                        $counter = 1;
                                        // $getProductInfo = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` ORDER BY mid ASC")or die(mysqli_error($connect_db));
                                        $getProductInfo = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE medicine_expiry_date <= curdate() ORDER BY mid ASC")or die(mysqli_error($connect_db));
                                        while($product_info = mysqli_fetch_array($getProductInfo)){  
                                        $get_product_id = $product_info['mid'];
                                        $get_product_name = $product_info['medicine_name'];

                                        $get_batch_no = $product_info['medicine_code'];
                                        $get_selling_price = $product_info['selling_price'];
                                        $get_cost_price = $product_info['cost_price'];
                                        $get_expiry = $product_info['medicine_expiry_date'];
                                            
                                            $get_current_date = date_create(date("d-M-Y"));
                                            $check_expire = date_create(date('d-M-Y', strtotime($get_expiry))); 
                                            $interval = date_diff( $get_current_date, $check_expire);

                                            $remaining_days = intval($interval->format('%R%a'));
                                            $months_remaining = $interval->format('%m months remaining');
                                            
                                            ?>
                                <?php
                                    if ($months_remaining <= $minimum && $remaining_days < 0) { 
                                    ?>
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

                                    <td class="text-danger">
                                        <?php if($remaining_days < 0){  ?>
                                        <?php echo 'Expired';   ?>
                                        <?php  }else{  ?>
                                        <?php echo $remaining_days." days remaining"; ?>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php echo date('d-m-Y', strtotime($get_expiry)) ;   ?>
                                    </td>
                                    
                                     <td>
                                        <button type="submit" class="btn btn-danger btn-sm font-weight-bold dispose" id="dispose" data-id="<?php echo $get_product_id; ?>">Dispose</button>
                                    </td>

                                </tr>
                                <?php  $counter++;  }
                             }  
                             ?>
                            </tbody>

                            </table>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

    <div class="details" style="display:none;">
        <div style="text-align: center;">
          <h3> Pharmacy Management & Billing System</h3>
          <p><b> Reports of Expired Medicines ( <?php echo date('Y') ?>)</b></p>
        </div>
     
    </div>

        </div> <!-- container -->

    </div> <!-- content -->


    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {

        // get and set user-role
        var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }

        $('#dispose-all').click(function(e) {
            $('#generic-modal').modal('show');

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

        // triggers to dispose off medicines
        $(document).on('click', '.dispose', function(e) {
            e.preventDefault();
            var supplierId = $(this).data('id');
            disposeMedicine(supplierId);
            e.preventDefault();
        });

    });

    // dispose all medicines
    function disposeAll(){

    }

    // dispose specific medicine
    function disposeMedicine(supplierId) {
       swal.fire({
			title: 'Are you Sure?',
			text: "This medicine will be disposed off permanently!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Dispose!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			     $.ajax({
			   		url: 'api_calls/medicine_api/dispose.medicine.php',
			    	type: 'POST',
			       	data: 'delete='+supplierId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal.fire('Disposed!', response.message, response.status);
                    location.reload();
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

    <script>
        $('#print').click(function(){
            var ns = $('.details').clone()
            var content = $('#tickets-table').clone()
            ns.append(content)

            var new_window = window.open('', '', 'height=700, width=900')
            new_window.document.write(ns.html())
            new_window.document.close()
            new_window.print()
            setTimeout(function(){
            new_window.close()
            }, 500)
        })
    </script>