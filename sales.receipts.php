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


## Query 3 - Get Currency
$sql_currency = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '7'")or die(mysql_error($connect_db));
$currency = mysqli_fetch_assoc($sql_currency);
$get_currency_value = $currency['settings_ans'];

// -- Query Ends Here

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
                            
                            <ol class="breadcrumb m-0 " style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Sales</a></li>
                                <li class="breadcrumb-item active">Sales Receipts</li>
                            </ol> 
                          
                        </div>
                            <h4 class="page-title font-weight-bold" style="letter-spacing: 1px; color: #145388;">Print Sales Receipts</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box">
                       
                            <table class="table table-sm table-bordered table-hover dt-responsive m-0 table-centered nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;">
                                        <th class="font-weight-bold">No.</th>
                                        <th class="font-weight-bold">Sales Id</th>
                                        <th class="font-weight-bold">Sub Total </th>
                                        <th class="font-weight-bold">Grand Total </th>
                                        <th class="font-weight-bold">Seller Name</th>
                                        <th class="font-weight-bold">Date Time</th>
                                        <th class="font-weight-bold">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                    $cnt = 1;
                                        $sql = "SELECT * from `tbl_special_sales` ORDER BY `sales_datetime` DESC";
                                        $query = $connect_db->query($sql);
                                        if(!empty($query)){
                                            while($row = $query->fetch_assoc()){
                                                $salesperson = $row['sales_seller_id'];    // Get Specific Seller ID
                                                // Query To Fetch Fullname of SalePerson 
                                                $get_query = $connect_db->query("SELECT user_firstname, user_lastname FROM `tbl_users` WHERE `uid`=$salesperson");
                                                $get_seller = $get_query->fetch_assoc();
                                                $sellers_fullname = $get_seller['user_firstname'].' '.$get_seller['user_lastname'];
                                            ?>
                                                <tr>
                                                    <td> <?php echo $cnt; ?></td>
                                                    <td><?php echo $row['sales_number']; ?></td>
                                                    <td class='text-center'><?php echo $get_currency_value.' '. $row['sales_subtotal']; ?></td>
                                                    <td class='text-center'><?php echo $get_currency_value.' '. $row['sales_total']; ?></td>
                                                    <td><?php echo $sellers_fullname; ?></td>
                                                    <td><?php echo date('d-m-Y H:m:sa ', strtotime($row['sales_datetime'])); ?></td>
                                                    <td> 
                                                        <a href="print.sales.receipt.php?action=print&salesid=<?php echo $row['sales_number'];?>" target="_blank" class="btn btn-default btn-flat btn-sm text-white print" style="background: #145388; "> <i class="mdi mdi-printer"></i> Print </a>
                                                    </td>
                                                </tr>
                                            <?php 
                                            $cnt += 1;
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


    <?php require_once 'modals/purchase.modal.php';   ?>
    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {
        
        var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }


        $('.datepicker').datepicker({
            orientation: 'bottom',
            autoclose: true,
        })

        $('#add-new-purchase').click(function(){
            $('#add-purchase-modal').modal('show');
        });

        // saves new generic
        $('#add-purchase-form').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

            $.ajax({
                    url: 'api_calls/purchases_api/add.purchase.php',
                    type: 'POST',
                    data: formdata,
                    success: function(res) {
                        Swal.fire('Success', 'Purchase Record Added..', 'success');
                        location.reload();
                        $('#add-purchase-modal').modal('hide');
                        $('#purchaseId').val('');
                        $('#purchaseDate').val('');
                        $('#purchaseDetails').val('');
                        $('#purchaseAmount').val('');

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
        $('#edit-purchase-form').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

            $.ajax({
                url: 'api_calls/purchases_api/edit.purchase.php',
                type: 'POST',
                data: formdata,
                success: function(res) {
                    
                    swal.fire('Updated!', 'Purchase Record Updated', 'success').then(function(){
                        window.location.href = 'purchases.list.php';
                    });
                    
                    $('#edit-purchase-modal').modal('hide');
                    $('#purchase_id').val('');
                    $('#purchase_code').val('');
                    $('#purchase_details').val('');
                    $('#purchase_date').val('');
                    $('#purchase_amount').val('');

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
        $(document).on('click', '.edit-purchase', function(e) {
            swal.fire('Denied!!', 'You ar not Permitted to Edit Purchase Information... We keep Track of All Products or Medicines Acquired to be Sold by the Pharmacy... Thank You.','info');
            // var categoryId = $(this).data('id');
            // $("#genericid").val(categoryId);
            // $("#generic_id").attr("data-id", "edit");
            //     $.ajax({
            //         url: 'api_calls/general_api/generic.details.php',
            //         type: 'POST',
            //         data: 'categoryId=' + categoryId,
            //         dataType: 'json',
            //         success: function(res) {
            //             // $('#cgeneric_id').val(res.mcid);
            //             $('#generic_name').val(res.generic_name);
            //             $('#generic_description').val(res.generic_description);

            //             $('#edit-modal').modal('show');
            //         },
            //         error: function(res) {
            //             console.log(res);
            //         }
            //     });
        });

        $(document).on('click', '.delete-purchase', function(e) {
            swal.fire('Denied!!', 'You ar not Permitted to Edit Purchase Information... We keep Track of All Products or Medicines Acquired to be Sold by the Pharmacy... Thank You.','info');

            // e.preventDefault();
            // var supplierId = $(this).data('id');
            // SwalDelete(supplierId);
            // e.preventDefault();
        });

    });

    function getPurchases() {
         $('#tickets-table').dataTable({
            paging: true,
            searching: true,
            "bDestroy": true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'api_calls/purchases_api/get.purchases.php'
            },
            'columns': [
                {
                    data: 'purchaseId'
                },
                {
                    data: 'purchaseDetails'
                },
                {
                    data: 'purchaseAmount'
                },
                {
                    data: 'purchaseBy'
                },
                {
                    data: 'purchaseDate'
                },
                {
                    data: 'action'
                }

            ]
        });
    }

    function SwalDelete(supplierId) {
       swal.fire({
			title: 'Delete Purchase',
			text: "It will be deleted permanently! Are you Sure?",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			     $.ajax({
			   		url: 'api_calls/purchases_api/delete.purchase.php',
			    	type: 'POST',
			       	data: 'delete='+supplierId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal.fire('Deleted!', response.message, response.status);
					window.location.href = 'purchases.list.php';
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