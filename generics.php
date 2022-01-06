<?php  

require_once 'session.php'; 


        require_once 'db/db.php'; 
        require_once 'template/header.manager.php'; 
        require_once 'template/topnav.manager.php'; 
        require_once 'template/menu.manager.php'; 

   

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
                            <button type="button" class="btn btn-primary btn-mdd waves-effect waves-light float-right"
                                id="add-new-generic">
                                <i class="fe-plus"></i> New Generic Name
                            </button> 
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Generic Names</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box">
                       
                            <table class="table table-hover m-0 table-centered nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;">
                                        <th class="font-weight-bold">Id</th>
                                        <th class="font-weight-bold">Generic Name</th>
                                        <th class="font-weight-bold">Description</th>
                                        <th class="font-weight-bold">Date Created</th>
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


    <?php require_once 'modals/generics.modal.php';   ?>
    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {
        fetchGenericList(); /* it will load products when document loads */
       

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