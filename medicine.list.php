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

 


    // get shop name 
    $get_shop = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '1'") or die(mysqli_error($connect_db));
    $get_shop_item = mysqli_fetch_array($get_shop);
    $shop_name = $get_shop_item['settings_ans'];    
    
    // get system title
    $get_title = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '2'") or die(mysqli_error($connect_db));
    $get_item = mysqli_fetch_array($get_title);
    $system_title = $get_item['settings_ans'];
    
    // get currency 
    $get_currency = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '7'") or die(mysqli_error($connect_db));
    $get_currency_item = mysqli_fetch_array($get_currency);
    $currency = $get_currency_item['settings_ans'];    
    
    // get printer option 
    $sql = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '11'") or die(mysqli_error($connect_db));
    $get_data = mysqli_fetch_array($sql);
    $printer = $get_data['settings_ans'];

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
                            <?php ?>
                            <button type="button" class="btn btn-info btn-md waves-effect waves-light font-weight-bold text-white float-right ml-4" id="print">
                             <i class="mdi mdi-printer"></i> Print 
                            </button>

                            <ol class="breadcrumb m-0" style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Medicines</a></li>
                                <li class="breadcrumb-item active">Medicine List</li>
                            </ol>
                        </div>
                        <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Medicine Lists</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box">
                       
                            <table class="table table-sm table-bordered table-hover m-0 table-centered table-responsive nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;">
                                        <th class="font-weight-bold"> Code</th>
                                        <th class="font-weight-bold">Medicine Name</th>
                                        <th class="font-weight-bold"> Description</th>
                                        <th class="font-weight-bold">Cost Price</th>
                                        <th class="font-weight-bold">Selling Price</th>
                                        <th class="font-weight-bold">Category </th>
                                        <th class="font-weight-bold">Generic Name </th>
                                        <th class="font-weight-bold">Dosage</th>
                                        <th class="font-weight-bold">Size/Weight </th>
                                        <th class="font-weight-bold">Brand Name </th>
                                        <th class="font-weight-bold">Expiry Date </th>
                                        <th class="font-weight-bold">Date Created</th>
                                    </tr>
                                </thead>

                                <tbody>
                                
                                </tbody>

                            </table>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
        <div class="details" style="display:none;">
            <div style="text-align: center;">
            <h3> <?php echo $shop_name; ?></h3>     
            <p><?php echo $system_title; ?></p>
            <p><b> List of Medicines</b></p>
            </div>
        
        </div>

        </div> <!-- container -->

    </div> <!-- content -->


    <?php require_once 'modals/generics.modal.php';   ?>
    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {

        let type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }

        const printer = '<?php echo $printer ?>';
        if(printer === '0'){
            $('#print').hide();
        }else if(printer === '1'){
            $('#print').show();
        }


        fetchMedicines(); /* it will load products when document loads */

        
        // print document
        $(document).on('click', '#print', function(e) {
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
        });

    });

    function fetchMedicines() {
         $('#tickets-table').dataTable({
            paging: true,
            searching: true,
            "bDestroy": true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'api_calls/medicine_api/fetch.medicine.list.php'
            },
            'columns': [
                {
                    data: 'medicine_code'
                },
                {
                    data: 'medicine_name'
                },
                {
                    data: 'medicine_description'
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
                    data: 'dosage'
                }, 
                {
                    data: 'package_size'
                }, 
                {
                    data: 'brand_name'
                }, 
                {
                    data: 'medicine_expiry_date'
                },
                {
                    data: 'created_on'
                }
            ]
        });
    }

   
    </script>