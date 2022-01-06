<?php  
    
    require_once 'session.php';

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
        echo "<script>window.location.href='index.php'";
    }


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
                            <button type="button" class="btn btn-primary btn-md waves-effect waves-light float-right"
                                id="add-new-supplier">
                                <i class="fe-plus"></i> Add New Supplier
                            </button> 
                        </div>
                              <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Suppliers</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box" style="border: 1px solid #56c2d6;" >
                       
                            <table class="table table-sm table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                <thead >
                                    <tr style="color: #145388;">
                                    <th class="font-weight-bold">Full Name</th>
                                    <th class="font-weight-bold">Phone No</th>
                                    <th class="font-weight-bold">E-Mail</th>
                                    <th class="font-weight-bold">Address</th>
                                    <th class="font-weight-bold">Date Created</th>
                                    <th class="font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                           

                            </table>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->


    <?php require_once 'modals/supplier.modal.php';   ?>
    <?php require_once 'template/footer.client.php';   ?>

    <script type='text/javascript'>
    $(document).ready(function() {

        // 
         var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }

        /* it will load products when document loads */
        readSuppliers(); 
       
        //  triggers add new supplier button
        $('#add-new-supplier').click(function(e) {
            $('#supplier-modal').modal('show');
              $("#supplier_id").attr("data-id", "add");
        });

        //triggers to submit form
        $('#supplier-form').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

            var user_action = $('#supplier_id').attr('data-id'); //getter

           if(user_action == 'add'){
                 $.ajax({
                url: 'api_calls/suppliers_api/add-supplier.php',
                type: 'POST',
                data: formdata,
                success: function(res) {

                    if(res == 'success'){
                    $.toast({
                        heading: "Success",
                        text: "Supplier Added Successfully",
                        position: "top-right",
                        loaderBg: "#5ba035",
                        icon: "success",
                        stack: "4"
                    });
                    readSuppliers();
                    $('#supplier-modal').modal('hide');
                    $('#name').val('');
                    $('#email').val('');
                    $('#phone').val('');
                    $('#address').val('');


                    }else{
                         $.toast({
                        heading: "Error",
                        text: "Sorry Something Went Wrong Adding The Supplier",
                        position: "top-right",
                        loaderBg: "#5ba035",
                        icon: "error",
                        stack: "4"
                    });
                    }
                   


                },
                error: function(res) {
                    console.log(res);
                }

            });
           }

              if(user_action == 'edit'){
                 $.ajax({
                        url:'api_calls/suppliers_api/edit-suppliers.php',
                        type: 'POST',
			       	    data: formdata,
                        success:function(res){
                            Swal.fire(
                        'Success!',
                        'Supplier Updated Successfully',
                        'success'
                        ).then(function(){readSuppliers()});
                      
                        $('#supplier-modal').modal('hide');
                        $('#supplier_id').val('');
                        $('#name').val('');
                        $('#phone').val('');
                        $('#email').val('');
                        $('#address').val('');

                        
                        },
                        error:function(res){
                            console.log(res);
                        }

                    });
           }

           
        });



        $('#edit-supplier-form').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

            $.ajax({
                url: 'api_calls/users_api/edit-users.php',
                type: 'POST',
                data: formdata,
                success: function(res) {
                    $.toast({
                        heading: "Success",
                        text: "User Editted Successfully",
                        position: "top-right",
                        loaderBg: "#5ba035",
                        icon: "success",
                        stack: "4"
                    });
                    readSuppliers();
                    $('#edit-modal').modal('hide');
                    $('#users_id').val('');
                    $('#fname').val('');
                    $('#lname').val('');
                    $('#username').val('');
                    $('#password').val('');
                    $('#contact').val('');


                },
                error: function(res) {
                    console.log(res);
                }

            });

        })



        $(document).on('click', '.edit-supplier-button', function(e) {
            var supplierId = $(this).data('id');
             $("#supplier_id").attr("data-id", "edit");
            $.ajax({
                url: 'api_calls/suppliers_api/supplier-details.php',
                type: 'POST',
                data: 'supplierId=' + supplierId,
                dataType: 'json',
                success: function(res) {
                    $('#supplier_id').val(res.supplier_id);
                    $('#name').val(res.supplier_name);
                    $('#phone').val(res.supplier_phone);
                    $('#email').val(res.supplier_email);
                    $('#address').val(res.supplier_address);

                    $('#supplier-modal').modal('show');
                },
                error: function(res) {
                    console.log(res);
                }
            });
        });

        $(document).on('click', '.delete-supplier-button', function(e) {
            e.preventDefault();
            var supplierId = $(this).data('id');
            SwalDelete(supplierId);
            e.preventDefault();
        });

    });

    function readSuppliers() {
         $('#tickets-table').dataTable({
            paging: true,
            searching: true,
            "bDestroy": true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'api_calls/suppliers_api/fetch-suppliers.php'
            },
            'columns': [
                {
                    data: 'supplier_name'
                },
                {
                    data: 'supplier_phone'
                },
                {
                    data: 'supplier_email'
                },
                 {
                    data: 'supplier_address'
                },
                {
                    data: 'supplier_timestamp'
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
			confirmButtonText: 'Yes, delete it!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			     $.ajax({
			   		url: 'api_calls/suppliers_api/delete-supplier.php',
			    	type: 'POST',
			       	data: 'delete='+supplierId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal.fire('Deleted!', response.message, response.status);
					readSuppliers();
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