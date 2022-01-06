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
                        <a href="add_ingredient.php" class="btn btn-md btn-info btn-dark waves-effect waves-light float-right"> <i class="fa fa-plus"></i> Add New Ingredient </a>

                        </div>
                        <h4 class="page-title font-weight-bold" style="letter-spacing:  2px;">Ingredients List</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <?php 

        if($_COOKIE['c_r'] === 'p' && $_COOKIE['u_r']==='p'){
            }else{  ?>
            <div class="row" >
                <div class="col-12" >
                     <div class="card-box" style="display: none;">
                        <div class="row">

                            <div class="col-lg-12 text-right">
                                <div class="text-lg-right mt-3 mt-lg-0">
                                    <a href="add_ingredient.php" class="btn btn-md btn-info btn-dark waves-effect waves-light float-right"> <i class="fa fa-plus"></i> Add New Ingredient </a>
                                </div>
                            </div><!-- end col-->
                            <!-- </form> -->
                        </div> <!-- end row -->
                    </div> <!-- end card-box -->
                </div><!-- end col-->
            </div>
            <!-- end row -->
            <?php } ?>


            <div class="row">
                <div class="col-12">
                     <div class="card-box" >

                        <table class="table table-hover table-striped m-0 table-centered dt-responsive nowrap w-100"
                            id="tickets-table">
                            <thead class="bg-info text-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Cost Price(Box)</th>
                                    <th>Cost Price(Pcs)</th>
                                    <th>Aval.(Box)</th>
                                    <th>Aval.(Pcs)</th>
                                    <th>Expiry Date</th>
                                    <th>Last Updated</th>

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
        readIngredients();
    });

    function readIngredients() {
            $('#tickets-table').dataTable({
                paging: true,
                searching: true,
                "bDestroy": true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': 'api_calls/ingredients_api/view-ingredient.php'
                },
                'columns': [{
                        data: 'ingredient_name'
                    },
                    {
                        data: 'cost_price_box'
                    },
                    {
                        data: 'cost_price_pcs'
                    },
                   
                    {
                        data: 'quantity_available_box'
                    },
                    {
                        data: 'quantity_available_pcs'
                    },
                     {
                        data: 'expiry_date'
                    },
                    {
                        data: 'last_updated'
                    }
                ]
            });
    }

 
    </script>