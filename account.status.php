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
                            <ol class="breadcrumb m-0" style="font-size: 11px;">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>  
                                <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                                <li class="breadcrumb-item active">Account Status</li>
                            </ol>
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Account Status</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                     <div class="card-box" >
                    
                            <table class="table m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;">
                                        <th class="font-weight-bold">ID</th>
                                        <th class="font-weight-bold">Status Name</th>
                                        <th class="font-weight-bold">Date Created</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM `tbl_account_status`";
                                        $query = $connect_db->query($sql);
                                        while($row = $query->fetch_assoc()){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['asid'];?></td>
                                                <td><?php echo $row['status_name'];?></td>
                                                <td><?php echo $row['status_date'];?></td>
                                            </tr>
                                        <?php
                                        } 
                                    ?>
                                </tbody>

                            </table>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->


    <?php require_once 'template/footer.client.php';  ?>

    <script>
        $(document).ready(function(){

            var type_text = '<?php echo $users_role?>';
            if(type_text === '1'){
                $('#user-type').html('Admin') ;
            }else{
                $('#user-type').html('Manager');
            }
        });
    </script>
