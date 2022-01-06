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
    header('Location; index.php');
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
                        <ol class="breadcrumb m-0" style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Stocks</a></li>
                                <li class="breadcrumb-item active">Stock on Hand</li>
                            </ol> 
                          
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Current Medicine Stocks</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box">
                       
                            <table class="table table-bordered table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388">
                                        <th class="font-weight-bold"> S/N</th>
                                        <th class="font-weight-bold">Medicine Code</th>
                                        <th class="font-weight-bold">Medicine Name</th>
                                        <th class="font-weight-bold">Medicine Description</th>
                                        <th class="font-weight-bold">Available Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $i = 1; // counter
                                     
                                        $sql_query = $connect_db->query("SELECT * FROM `tbl_medicines` p INNER JOIN `tbl_temporary_stocks` ts on p.mid=ts.medicine_id ORDER BY `stock_level` DESC");
                                        while($row= $sql_query->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <th class="text-center"> <b> <?php echo $i++; ?> </b></th>
                                            <td> <?php echo ucwords($row['medicine_code']); ?> </td>
                                            <td> <?php echo $row['medicine_name']; ?> </td>
                                            <td> <?php echo $row['medicine_description']; ?> </td>
                                            <td class="text-center"><b class="text-danger"> <?php echo $row['stock_level']; ?></b></td>
                                            
                                        </tr>	
                                    <?php endwhile; ?>
                                    </tbody>

                            </table>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->


    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {
       
         var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }
      
    });

    function getStocksAvailable() {
         $('#tickets-table').dataTable({
            paging: true,
            searching: true,
            "bDestroy": true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'api_calls/stock_api/get.current.stocks.php'
            },
            'columns': [
                {
                    data: 'medicine_code'
                },
                {
                    data: 'medicine_name'
                },
                {
                    data: 'stock_level'
                }

            ]
        });
    }

   
    </script>