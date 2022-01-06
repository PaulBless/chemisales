<?php  

// Add Required Resources 
require_once 'session.php'; 

if($user_role === '1'){
require_once 'db/db.php'; 
require_once 'template/header.admin.php'; 
require_once 'template/topnav.admin.php'; 
require_once 'template/menu.admin.php'; 
}else if($users_role === '2'){
require_once 'db/db.php'; 
require_once 'template/header.admin.php'; 
require_once 'template/topnav.admin.php'; 
require_once 'template/menu.admin.php'; 
}else{
    header('location: index.php');
}


     

// get currency symbol 
$get_currency = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '7'") or die(mysqli_error($connect_db));
$get_currency_item = mysqli_fetch_array($get_currency);
$currency = $get_currency_item['settings_ans'];


$stock_creator = "";
if(isset($_SESSION['user']))
    $stock_creator = $_SESSION['user'];

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
                                <li class="breadcrumb-item active">Inventory</li>
                            </ol> 
                          
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Inventory List</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box">
                       
                            <table class="table table-bordered table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;"> 
                                        <th class="font-weight-bold">No</th>
                                        <th class="font-weight-bold">Stock ID</th>
                                        <th class="font-weight-bold">Medicine Name</th>
                                        <th class="font-weight-bold">Quantity</th>
                                        <th class="font-weight-bold">Total Cost </th>
                                        <th class="font-weight-bold">Stock Date</th>
                                        <th class="font-weight-bold">Supplier Name</th>
                                        <th class="font-weight-bold">Stock Added By</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                        $i = 1; // counter
                                       
                                        $sql_query = $connect_db->query("SELECT DISTINCT(stock_unique_id), medicine_name, medicine_description, item_quantity, item_total_amount, stock_date, stocked_by, stock_supplier_id FROM `tbl_medicines` p INNER JOIN `tbl_stocks` s ON p.`mid`=s.`stock_medicine_id` ORDER BY `stock_date` DESC");
                                        while($row= $sql_query->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <th class="text-center"> <?php echo $i++; ?> </th>
                                            
                                            <td class="text-dark"> <b>  <?php echo ($row['stock_unique_id']); ?> </b> </td>
                                            
                                            <td> <?php  echo $row['medicine_name']; ?> </td>
                                            
                                            <td class="text-center"> <?php echo $row['item_quantity']; ?> </td>
                                            
                                            <td class="text-right"> <?php echo $currency.' '. $row['item_total_amount']; ?></td>
                                            
                                            <td> <?php echo date('d M, Y', strtotime($row['stock_date'])) ; ?>  </td>
                                            
                                            <td class="text-dark"> 
                                                <?php  
                                                       //fetch corresponding supplier
                                                       $get_supplier_query=mysqli_query($connect_db, "select `supplier_name` from `tbl_suppliers` where supplier_id='".$row['stock_supplier_id']."'");
                                                       $supplier_name = mysqli_fetch_array($get_supplier_query);
                                                       if(empty($supplier_name['supplier_name'])) echo "Unknown Supplier"; else
                                                       echo $supplier_name['supplier_name'];
                                                
                                                ?>
                                            </td>
                                            
                                            <td class="text-dark">
                                                <?php  
                                                       $sql = "SELECT * FROM `tbl_users` WHERE `uid` = '$stock_creator'";
                                                       $query = $connect_db->query($sql);
                                                       $user_details = $query->fetch_assoc();
                                                       $fullname = $user_details['user_firstname'].' '.$user_details['user_lastname'];
                                                       if(empty($fullname)) echo "No Valid Name"; else echo $fullname;
                                                ?>
                                            </td>
                                            
                                        </tr>	
                                    <?php endwhile; ?>
                                </tbody>

                            </table>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->


    <?php require_once 'modals/inventory.modal.php';   ?>
    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {      
        
        var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }


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