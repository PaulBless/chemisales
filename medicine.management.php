<?php 

    require_once 'session.php'; 

    if($users_role === '1'){
        require_once 'db/db.php'; 
        require_once 'template/header.admin.php'; 
        require_once 'template/topnav.admin.php'; 
        require_once 'template/menu.admin.php'; 
    }else if($users_role === '2'){
        require_once 'db/db.php'; 
        require_once 'template/header.manager.php'; 
        require_once 'template/topnav.manager.php'; 
        require_once 'template/menu.manager.php'; 
    }else{
        header('location: index.php');
    }

     




// Get Currency Value/Symbol
$get_currency = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '7'") or die(mysqli_error($connect_db));
$get_currency_item = mysqli_fetch_array($get_currency);
$currency = $get_currency_item['settings_ans'];

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
                            <a href="medicine.entry.php" class="btn btn-pink btn-md waves-effect waves-light float-right">
                                <i class="mdi mdi-pill mr-1"></i>New Medicine Entry
                            </a> 
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Medicine Management</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box">
                    
                            <table class="table table-sm table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;">
                                        <th class="font-weight-bold">Medicine Code</th>
                                        <th class="font-weight-bold">Medicine Name</th>
                                        <th class="font-weight-bold">Cost Price</th>
                                        <th class="font-weight-bold">Selling Price</th>
                                        <th class="font-weight-bold">Category</th>
                                        <th class="font-weight-bold">Generic Name</th>
                                        <th class="font-weight-bold">Expiry Date </th>
                                        <th class="font-weight-bold">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                
                                </tbody>

                            </table>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->


    <?php require_once 'modals/medicine.modal.php';   ?>
    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {
        getMedicines();  /* it will load medicines list when document loads */
       
     
   
        // updates the medicine
        $('#edit_medicine').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

            $.ajax({
                url: 'api_calls/medicine_api/edit.medicine.php',
                type: 'POST',
                data: formdata,
                success: function(res) {
                   
                    swal.fire('Success!', 'Changes applied, Medicine details updated', 'success');
                    getMedicines();
                    $('#edit-medicine-modal').modal('hide');
                    $('#medicine-id').val('');
                    $('#medicine-name').val('');
                    $('#medicine-code').val('');
                    $('#selling-price').val('');
                    $('#cost-price').val('');
                    $('#brand-name').val('');
                    $('#package-size').val('');
                    $('#description').val('');
                    $('#dosage').val('');
                    $('#mfg-date').val('');
                    $('#expiry-date').val('');
                    $('#medicine-category').val('');
                    $('#generic-name').val('');

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
            var medicineId = $(this).data('id');            
                $.ajax({
                    url: 'api_calls/medicine_api/medicine.details.php',
                    type: 'POST',
                    data: 'medicineId=' + medicineId,
                    dataType: 'json',
                    success: function(res) {
                        $('#medicine-id').val(res.mid);
                        $('#medicine-name').val(res.medicine_name);
                        $('#medicine-code').val(res.medicine_code);
                        $('#description').val(res.medicine_description);
                        $('#dosage').val(res.dosage);
                        $('#mfg-date').val(res.manufacture_date);
                        $('#expiry-date').val(res.medicine_expiry_date);
                        $('#cost-price').val(res.cost_price);
                        $('#selling-price').val(res.selling_price);
                        $('#brand-name').val(res.brand_name);
                        $('#package-size').val(res.package_size);
                        $('#supplier-name').val(res.suppliers_id);
                        $('#generic-name option[value=' + res.generic_name + ']').attr('selected','selected');
                        $('#generic-name').selectpicker('refresh');
                        $('#medicine-category option[value=' + res.med_cat_name + ']').attr('selected', 'selected');
                        $('#medicine-category').selectpicker('refresh');

                        $('#edit-medicine-modal').modal('show');
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

    function getMedicines() {
         $('#tickets-table').dataTable({
            paging: true,
            searching: true,
            "bDestroy": true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'api_calls/medicine_api/fetch.medicines.php'
            },
            'columns': [
                {
                    data: 'medicine_code'
                },
                {
                    data: 'medicine_name'
                },
                {
                    data: 'cost_price'
                },
                {
                    data: 'selling_price'
                }, 
                {
                    data: 'med_cat_name'
                }, 
                {
                    data: 'generic_name'
                },
                {
                    data: 'medicine_expiry_date'
                }, 
                {
                    data: 'action'
                }

            ]
        });
    }

    function SwalDelete(supplierId) {
       swal.fire({
			title: 'Delete Medicine!',
			text: "This medicine will be deleted permanently, You cannot undo, Are you Sure!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			     $.ajax({
			   		url: 'api_calls/medicine_api/delete.medicine.php',
			    	type: 'POST',
			       	data: 'delete='+supplierId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal.fire('Deleted!', response.message, response.status);
					getMedicines();
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