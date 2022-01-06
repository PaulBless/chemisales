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
                                id="add-staff">
                                <i class="fe-plus"></i> New Staff User 
                            </button> 
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Staff & Users</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box">
                       
                            <table class="table table-sm table-bordered table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;">
                                        <th class="font-weight-bold">User ID</th>
                                        <th class="font-weight-bold">FirstName</th>
                                        <th class="font-weight-bold">LastName</th>
                                        <th class="font-weight-bold">Phone No</th>
                                        <th class="font-weight-bold">UserName</th>
                                        <th class="font-weight-bold">User Role </th>
                                        <th class="font-weight-bold">Status</th>
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


    <?php require_once 'modals/staff.modal.php';   ?>
    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {

        var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }

        getList(); /* it will load products when document loads */
        
        $('select').niceSelect();

        $('#add-staff').click(function(e) {
            $('#add-modal').modal('show');
        });

        // saves new generic
        $('#add_new_user').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();
            var entname = $("#fname").val();
            var iprep = "@";
            var uname = iprep + entname;
            var password = "password";

                $.ajax({
                    url: 'api_calls/staff_api/add.staff.php',
                    type: 'POST',
                    data: formdata,
                    success: function(res) {
                       // show success message
                        swal.fire({
                            title: "User Created Successfully",
                            html: "User Login Details: </br> <span class='text-info'> Username : </span>" + uname + " </br> <span class='text-info'>Password : </span>" + password,
                            type: "info"
                        });

                        getList();
                        $('#add-modal').modal('hide');
                        $('#fname').val('');
                        $('#lname').val('');
                        $('#mobile').val('');
                        $('#user_role').val('Nothing');
                        $('#user_status').val('Nothing');
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
        $('#edit_staff_user').submit(function(e) {
            e.preventDefault();
            ;

            var formdata = $(this).serialize();

            $.ajax({
                url: 'api_calls/staff_api/edit.staff.php',
                type: 'POST',
                data: formdata,
                success: function(res) {
                         
                        swal.fire(
                            'Success!', 
                            'Staff details updated successfully..', 
                            'success');

                        getList(); 
                        $('#edit-modal').modal('hide');
                        $('#users_idno').val('');
                        $('#firstname').val('');
                        $('#lastname').val('');
                        $('#mobileno').val('');
                        $('#users_role').val('');                   
                    
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

        // triggers to find specific user action status
        $('.submit-btn').on('click', function(){
            var user_action = $(this).attr('id');
            $('#action_status').val(user_action);
            // alert(user_action);
        })

        // triggers edit button click
        $(document).on('click', '.edit-button', function(e) {
            var productId = $(this).data('id');
                $.ajax({
                    url: 'api_calls/staff_api/staff.details.php',
                    type: 'POST',
                    data: 'productId=' + productId,
                    dataType: 'json',
                    success: function(res) {
                        
                        $('#users_idno').val(res.uid);
                        $('#firstname').val(res.user_firstname);
                        $('#lastname').val(res.user_lastname);
                        $('#mobileno').val(res.user_mobileno);
                        $('#users_loginid').val(res.user_loginid);
                        $('#users_code').val(res.user_code);
                        
                        // nice select
                        $('#users_role option[value=' + res.role_name + ']').attr('selected', 'selected');
                        $('#users_role').niceSelect('update');
                        $('#users_status option[value=' + res.status_name + ']').attr('selected', 'selected');
                        $('#users_status').niceSelect('update');
                        // display edit-record modal
                        $('#edit-modal').modal('show');

                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
        });
        
        // trigger delete button action
        $(document).on('click', '.delete-button', function(e) {
            e.preventDefault();
            var supplierId = $(this).data('id');
            SwalDelete(supplierId);
            e.preventDefault();
        }); 
        
        // trigger reset password button action
        $(document).on('click', '.reset-button', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            resetUserPassword(userId);
            e.preventDefault();
        });

    });

    function getList() {
         $('#tickets-table').dataTable({
            paging: true,
            searching: true,
            "bDestroy": true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'api_calls/staff_api/fetch.staff.php'
            },
            'columns': [
                {
                    data: 'user_code'
                },
                {
                    data: 'user_firstname'
                },  
                {
                    data: 'user_lastname'
                }, 
                {
                    data: 'user_mobileno'
                },
                {
                    data: 'user_loginid'
                },
                {
                    data: 'role_name'
                }, 
                {
                    data: 'status_name'
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
			text: "Staff will be deleted permanently, Are you Sure!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			     $.ajax({
			   		// url: 'api_calls/general_api/delete.generic.php',
			   		url: 'api_calls/staff_api/delete.staff.php',
			    	type: 'POST',
			       	data: 'delete='+supplierId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal.fire('Deleted!', response.message, response.status);
					getList();
			     })
			     .fail(function(){
			     	swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
			     });
			  });
		    },
			allowOutsideClick: false			  
		});	

    }
    
    function resetUserPassword(userId) {
       swal.fire({
			title: 'Password Reset!',
			text: "This action will Reset Staff Password, and Generate New Password, Are you Sure?",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Reset!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			     $.ajax({
			   		url: 'api_calls/staff_api/reset.staff.password.php',
			    	type: 'POST',
			       	data: 'reset='+userId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal.fire('Success!', response.message, response.status);
					getList();
			     })
			     .fail(function(){
			     	swal.fire('Ooops...', 'Something went wrong with ajax !', 'error');
			     });
			  });
		    },
			allowOutsideClick: false			  
		});	

    }
    </script>