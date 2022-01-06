<?php  

    require_once 'session.php'; 

    if($users_role === '1'){
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
                            
                            <button type="button" class="btn btn-primary btn-md waves-effect waves-light float-right ml-4"
                                id="add-new-expense">
                                <i class="fe-plus"></i> Add New Expense
                            </button> 

                            <ol class="breadcrumb m-0 d-none" style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item active">Expenses</li>
                            </ol> 
                            

                        </div>
                            <h4 class="page-title font-weight-bold" style="letter-spacing: 1px; color: #145388;">All Expenses</h4>
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
                                        <th class="font-weight-bold">No.</th>
                                        <th class="font-weight-bold">Expense Id</th>
                                        <th class="font-weight-bold">Expense Description </th>
                                        <th class="font-weight-bold">Amount </th>
                                        <th class="font-weight-bold">Created By</th>
                                        <th class="font-weight-bold">Expense Date </th>
                                        <th class="font-weight-bold">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                        $cnt = 1;
                                        $sql = "SELECT DISTINCT(expense_id), eid, expense_details, expense_amount, expense_date, user_firstname, user_lastname from `tbl_expenses` join `tbl_users` on tbl_expenses.expense_creator = tbl_users.uid  WHERE 1 ORDER BY expense_date DESC";
                                        $query = $connect_db->query($sql);
                                        if(!empty($query)){
                                            while($row = $query->fetch_assoc()){
                                                ?>
                                                <tr>
                                                    <td> <?php echo $cnt; ?> </td>
                                                    <td> <?php echo $row['expense_id']; ?> </td>
                                                    <td> <?php echo $row['expense_details']; ?> </td>
                                                    <td class="text-right"> <?php echo $get_currency_value.' '.$row['expense_amount']; ?> </td>
                                                    <td> <?php echo $row['user_firstname'].' '.$row['user_lastname']; ?> </td>
                                                    <td> <?php echo date('d M, Y', strtotime($row['expense_date'])); ?></td>
                                                    
                                                    <td> 
                                                        <div class="btn-group dropdown">
                                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-default btn-flat btn-sm border-info text-dark" data-toggle="dropdown" aria-expanded="false"> Action <i class="mdi mdi-chevron-down"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-bottom">
                                                                <a class="dropdown-item edit-button" href="javascript:void(0)" data-id="<?php echo $row['eid'];?>"><i class="mdi mdi-pencil mr-1 text-primary font-18 vertical-middle" ></i>Edit Expense</a>
                                                                <a class="dropdown-item delete-expense" href="javascript:void(0)"  data-id="<?php echo $row['eid']; ?>"><i class="mdi mdi-delete mr-1 text-danger font-18 vertical-middle"></i>Delete Expense</a>
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


    <?php require_once 'modals/expense.modal.php';   ?>
    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {

         var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }

        
        // get list of expense 
        // getExpenses(); 

        // 
        $(".datepicker").datepicker({
            orientation: 'bottom',
            autoclose: true,
        });

        // trigger new button click
        $('#add-new-expense').click(function(e) {
            $('#add-expense-modal').modal('show');
        });

        // saves new expense
        $('#add-expense-form').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

                $.ajax({
                    url: 'api_calls/expenses_api/add.expense.php',
                    type: 'POST',
                    data: formdata,
                    success: function(res) {
                        Swal.fire('Success', 'Expense Record Added..', 'success');
                        location.reload();
                        $('#add-expense-modal').modal('hide');
                        $('#expenseId').val('');
                        $('#expenseDate').val('');
                        $('#expenseDetails').val('');
                        $('#expenseAmount').val('');

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
        $('#edit-expense-form').submit(function(e) {
            
            e.preventDefault();
            var formdata = $(this).serialize();

            $.ajax({
                url: 'api_calls/expenses_api/edit.expense.php',
                type: 'POST',
                data: formdata,
                success: function(res) {
                    
                    swal.fire('Updated!', 'Expense Record Updated', 'success').then(function(){
                        window.location.href = 'expenses.list.php';
                    });
                    
                    $('#edit-expense-modal').modal('hide');
                    $('#expense_id').val('');
                    $('#expense_code').val('');
                    $('#expense_details').val('');
                    $('#expense_date').val('');
                    $('#expense_amount').val('');

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
            var expenseId = $(this).data('id');
            $.ajax({
            url: 'api_calls/expenses_api/expense.details.php',
            type: 'POST',
            data: 'expenseId=' + expenseId,
            dataType: 'json',
            success: function(res) {
                $('#expense_id').val(res.eid);
                $('#expense_code').val(res.expense_id);
                $('#expense_details').val(res.expense_details);
                $('#expense_amount').val(res.expense_amount);
                $('#expense_date').val(res.expense_date);


                $('#edit-expense-modal').modal('show');
                $('.datepicker').removeClass('hasDatepicker').datepicker({
                    orientation: 'bottom',
                    autoclose: true,
                })
            },
            error: function(res) {
                console.log(res);
            }
            });
        });


        $(document).on('click', '.delete-expense', function(e) {
            e.preventDefault();
            var supplierId = $(this).data('id');
            SwalDelete(supplierId);
            e.preventDefault();
        });

    });

    function getExpenses() {
         $('#tickets-table').dataTable({
            paging: true,
            searching: true,
            "bDestroy": true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'api_calls/expenses_api/get.expenses.php'
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

    function SwalDelete(expenseId) {
       swal.fire({
			title: 'Delete Expense',
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
			   		url: 'api_calls/expenses_api/delete.expense.php',
			    	type: 'POST',
			       	data: 'delete='+expenseId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal.fire('Deleted!', response.message, response.status).then(function(){  
                         window.location.href = 'expenses.list.php';
                    });
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