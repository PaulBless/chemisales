<?php  require_once 'db/db.php'; ?>


<?php 

    if($_COOKIE['c_r'] === 'p' && $_COOKIE['u_r']==='p'){
        require_once 'header/client-header.php'; 
        require_once 'sidebar/client-sidebar.php';   
    }else{
        require_once 'header/admin-header.php'; 
        require_once 'sidebar/admin-sidebar.php';   
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

                        </div>
                              <h4 class="page-title font-weight-bold" style="letter-spacing: 1px;">Products</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box" >

                        <h4 class="header-title mb-4 text-dark" style="letter-spacing: 1px;">View Products</h4>
                        <!-- <div id="fetch-products">

                        </div> -->

                        <table class="table table-hover table-centered dt-responsive m-0 nowrap w-100" id="tickets-table">
                            <thead class="bg-info text-dark">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Cost Price (Box)</th>
                                    <th>Cost Price (Pcs)</th>
                                    <th>Selling Price (Box)</th>
                                    <th>Selling Price (Pcs)</th>
                                    <th>Expiry Date</th>
                                    <th>Aval. (Box)</th>
                                     <th>Aval. (Pcs)</th>

                                </tr>
                            </thead>


                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    
    <?php require_once 'modals/user_record_modal.php';   ?>
    <?php require_once 'footer/admin-footer.php';   ?>

    <script type='text/javascript'>
    $(document).ready(function() {
        fetch_data();

    });

    function fetch_data() {

        $('#tickets-table').dataTable({
            paging: true,
            searching: true,
            "bDestroy": true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'api_calls/products_api/view-products.php'
            },
            'columns': [
                {
                    data: 'product_name'
                },
                {
                    data: 'product_category'
                },
                {
                    data: 'cost_price_box'
                },
                 {
                    data: 'cost_price_pcs'
                },
                {
                    data: 'selling_price_box'
                },
                {
                    data: 'selling_price_pcs'
                },
                {
                    data: 'expiry_date'
                },
                {
                    data: 'quantity_available_box'
                },
                 {
                    data: 'quantity_available_pcs'
                }

            ]
        });

    }
    </script>