<?php  

    require_once 'session.php'; 
    require_once 'db/db.php'; 
    require_once 'template/header.manager.php'; 
    require_once 'template/topnav.manager.php'; 
    require_once 'template/menu.manager.php'; 


    ## Query 3 - Get Currency
    $sql_currency = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '7'")or die(mysql_error($connect_db));
    $currency = mysqli_fetch_assoc($sql_currency);
    $currency_value = $currency['settings_ans'];

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
                            <button type="button" class="btn btn-primary btn-md waves-effect waves-light float-right ml-4"
                                id="add-new-purchase">
                                <i class="fa fa-plus"></i> Add New Purchase
                            </button>
                            
                            <ol class="breadcrumb m-0 d-nonee" style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item active">Purchases</li>
                            </ol> 
                          
                        </div>
                            <h4 class="page-title font-weight-bold" style="letter-spacing: 1px; color: #145388;">All Purchases</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box">
                       
                            <table class="table table-sm table-hover m-0 dt-centered dt-responsive nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;">
                                        <th class="font-weight-bold">No.</th>
                                        <th class="font-weight-bold">Purchase Id</th>
                                        <th class="font-weight-bold">Purchase Description </th>
                                        <th class="font-weight-bold">Amount </th>
                                        <th class="font-weight-bold">Created By</th>
                                        <th class="font-weight-bold">Purchase Date</th>
                                        <th class="font-weight-bold">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                    $cnt = 1;
                                        $sql = "SELECT * from `tbl_purchases` join `tbl_users` on `tbl_purchases`.`purchase_created_by` = `tbl_users`.`uid`  WHERE 1 ORDER BY `purchase_date` DESC";
                                        $query = $connect_db->query($sql);
                                        if(!empty($query)){
                                            while($row = $query->fetch_assoc()){
                                           ?>
                                                <tr>
                                                    <td> <?php echo $cnt; ?></td>
                                                    <td><?php echo $row['purchase_id']; ?></td>
                                                    <td><?php echo $row['purchase_details']; ?></td>
                                                    <td class='text-right'><?php echo $currency_value.' '. $row['purchase_amount']; ?></td>
                                                    <td><?php echo $row['user_firstname'].' '.$row['user_lastname']; ?></td>
                                                    <td><?php echo date('d M, Y', strtotime($row['purchase_date'])); ?></td>
                                                    <td> 
                                                        <div class="btn-group dropdown">
                                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-default btn-flat btn-sm border-info text-dark" data-toggle="dropdown" aria-expanded="false"> Action <i class="mdi mdi-chevron-down"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-bottom">
                                                                <a class="dropdown-item edit-purchase" href="javascript:void(0)" data-id="<?php echo $row['pid'];?>"><i class="mdi mdi-pencil mr-1 text-primary font-18 vertical-middle" ></i>Edit Purchase</a>
                                                                <a class="dropdown-item delete-purchase" href="javascript:void(0)"  data-id="<?php echo $row['pid']; ?>"><i class="mdi mdi-delete mr-1 text-danger font-18 vertical-middle"></i>Delete Purchase</a>
                                                            </div>
                                                        </div>
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
            swal.fire('Denied!!', 'You are not Permitted to Edit Purchase Information... We keep Track of All Products or Medicines Acquired to be Sold by the Pharmacy... Thank You.','info');
            
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
            swal.fire('Denied!!', 'You are not Permitted to Delete Purchase Information... We keep Track of All Products or Medicines Acquired to be Sold by the Pharmacy... Thank You.','warning');

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