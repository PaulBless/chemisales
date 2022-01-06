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
        header('Location: index.php');
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
                                id="add-new-category">
                                <i class="fe-plus"></i> New Category
                            </button> 
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Categories</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box" >
                       
                            <table class="table table-bordered table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                <thead >
                                    <tr style="color: #145388;">
                                        <th class="font-weight-bold">Category Name</th>
                                        <th class="font-weight-bold">Description</th>
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


    <?php require_once 'modals/drug.categories.modal.php';   ?>
    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {

         var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }


        fetchCategories(); /* it will load products when document loads */
       

        $('#add-new-category').click(function(e) {
            $('#category-modal').modal('show');
              $("#category_id").attr("data-id", "add");
        });

        // saves new category
        $('#category-form').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

                $.ajax({
                    url: 'api_calls/general_api/add.category.php',
                    type: 'POST',
                    data: formdata,
                    success: function(res) {
                        $.toast({
                            heading: "Success",
                            text: "Medicine Category Saved",
                            position: "top-right",
                            loaderBg: "#5ba035",
                            icon: "success",
                            stack: "4"
                        });
                        fetchCategories();
                        $('#category-modal').modal('hide');
                        $('#name').val('');
                        $('#description').val('');
                    },
                    error: function(res) {
                        console.log(res);  
                        $.toast({
                            heading: "Error",
                            text: "Sorry, something went wrong while adding record",
                            position: "top-right",
                            loaderBg: "#bf441d",
                            icon: "error",
                            stack: "4"
                        });
                    }
            });
        });

        // updates the category
        $('#edit-category-form').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

            $.ajax({
                url: 'api_calls/general_api/edit.category.php',
                type: 'POST',
                data: formdata,
                success: function(res) {
                    $.toast({
                        heading: "Success",
                        text: "Changes applied successfully",
                        position: "top-right",
                        loaderBg: "#5ba035",
                        icon: "success",
                        stack: "4"
                    });
                    fetchCategories();
                    $('#edit-modal').modal('hide');
                    $('#categoryid').val('');
                    $('#category_name').val('');
                    $('#category_description').val('');

                },
                error: function(res) {
                    console.log(res);
                    $.toast({
                        heading: "Error",
                        text: "Oooops...  Process request error, could not update",
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
            $("#categoryid").val(categoryId);
            $("#category_id").attr("data-id", "edit");
                $.ajax({
                    url: 'api_calls/general_api/category.details.php',
                    type: 'POST',
                    data: 'categoryId=' + categoryId,
                    dataType: 'json',
                    success: function(res) {
                        // $('#category_id').val(res.mcid);
                        $('#category_name').val(res.med_cat_name);
                        $('#category_description').val(res.med_cat_comment);

                        $('#edit-modal').modal('show');
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
        });

        // triggers delete button click
        $(document).on('click', '.delete-button', function(e) {
            e.preventDefault();
            var supplierId = $(this).data('id');
            SwalDelete(supplierId);
            e.preventDefault();
        });

    });

    function fetchCategories() {
         $('#tickets-table').dataTable({
            paging: true,
            searching: true,
            "bDestroy": true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'api_calls/general_api/fetch.categories.php'
            },
            'columns': [
                {
                    data: 'med_cat_name'
                },
                {
                    data: 'med_cat_comment'
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
			   		url: 'api_calls/general_api/delete.category.php',
			    	type: 'POST',
			       	data: 'delete='+supplierId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal.fire('Deleted!', response.message, response.status);
					fetchCategories();
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