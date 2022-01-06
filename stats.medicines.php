<?php  

    // Include Files
    require_once 'session.php';  
    // Role Based Access Management
    if($users_role === '1'){
        require_once 'db/db.php'; 
        require_once 'template/header.admin.php'; 
        require_once 'template/topnav.admin.php'; 
        require_once 'template/menu.admin.php'; 
        require_once 'fetch-data/statistics.info.php'; 

     }else if ($users_role === '2'){
        require_once 'db/db.php'; 
        require_once 'template/header.manager.php'; 
        require_once 'template/topnav.manager.php'; 
        require_once 'template/menu.manager.php'; 
        require_once 'fetch-data/statistics.info.php'; 

    }else{
        echo "<script>window.location.href='index.php'</script>";
    }

?>

<?php 
    // Query Database For Settings Information
    $get_system_name = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 1") or die(mysqli_error($connect_db));
    $get_name = mysqli_fetch_array($get_system_name);
    $system_name = $get_name['settings_ans'];

    $get_system_title = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 2") or die(mysqli_error($connect_db));
    $get_title = mysqli_fetch_array($get_system_title);
    $system_title = $get_title['settings_ans'];

    $get_address = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 3") or die(mysqli_error($connect_db));
    $get_address_item = mysqli_fetch_array($get_address);
    $address = $get_address_item['settings_ans'];

    $get_contact = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 4") or die(mysqli_error($connect_db));
    $get_contact_item = mysqli_fetch_array($get_contact);
    $contact = $get_contact_item['settings_ans'];

    $get_email = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 5") or die(mysqli_error($connect_db));
    $get_email_item = mysqli_fetch_array($get_email);
    $email = $get_email_item['settings_ans'];

    $get_quantity_alert = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 6") or die(mysqli_error($connect_db));
    $get_quantity_alert_item = mysqli_fetch_array($get_quantity_alert);
    $quantity_alert = $get_quantity_alert_item['settings_ans'];

    $get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
    $get_currency_item = mysqli_fetch_array($get_currency);
    $currency = $get_currency_item['settings_ans'];

    $get_expire_alert = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 8") or die(mysqli_error($connect_db));
    $get_expire_alert_item = mysqli_fetch_array($get_expire_alert);
    $expire_alert = $get_expire_alert_item['settings_ans'];

    $get_invoice_due = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 9") or die(mysqli_error($connect_db));
    $get_invoice_due_item = mysqli_fetch_array($get_invoice_due);
    $invoice_due = $get_invoice_due_item['settings_ans'];


    $get_profile_pic = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 10") or die(mysqli_error($connect_db));
    $get_profile_pic_item = mysqli_fetch_array($get_profile_pic);
    $profile = $get_profile_pic_item['settings_ans'];


    // function to fetch most sold medicines
    function monthlySoldDrugs(){
    require_once 'db/db.php';

		$id = 1;    // table row counter
        $qty_counter = 0;
        $price_counter = 0;

		// $select = mysqli_query($connect_db, "SELECT * FROM `tbl_special_sales` WHERE YEAR(sales_datetime) = YEAR(CURDATE()) AND MONTH(sales_datetime)=MONTH(CURDATE())");
        $get_number = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE YEAR(sales_datetime)=YEAR(CURDATE()) AND MONTH(sales_datetime)=MONTH(CURDATE())")or die(mysqli_error($connect_db));		
        while($query_row = mysqli_fetch_array($get_number)){
			$selected_sales_number = $query_row['sales_number'];	//sales number;

            // fetch sales details for required month
            $get_all_related = mysqli_query($connect_db,"SELECT `medicineId`, SUM(medicineQty) AS `qty_sold`, SUM(medicineTotal) AS `price` FROM `tbl_sales` WHERE `sales_id_number` = '$selected_sale_number' GROUP BY `medicineId` ORDER BY `qty_sold` DESC ")or die(mysqli_error($connect_db));
            while ($each_sale = mysqli_fetch_array($get_all_related)) :
                $productId = $each_sale['medicineId'];
                $qty_counter+= $each_sale['qty_sold'];
                $price_counter+= $each_sale['price'];
            
                // get medicine detail
                $sql = "SELECT * FROM `tbl_medicines` WHERE mid = '$productId' ";
                $fetch_query=$connect_db->query($sql)or die($connect_db->mysqli_error());
                $read = $fetch_query->fetch_assoc();
                $medicine_name = $read['medicine_name'];

            endwhile;

		?>
			<tr><td><?php echo $id++; ?></td>
				<td><?php echo $medicine_name; ?></td>
				<td><?php echo $total_counter; ?></td>
				<td><?php echo $price_counter; ?></td>
				<!-- <td>
					<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editcustomer_<?php echo $b_id; ?>"><i class="fa fa-edit"></i> Update</button>
					<button class="btn btn-danger btn-sm del_center" data-toggle="modal" data-target="#del_<?php echo $b_id; ?>"><i class="fa fa-trash"></i> Delete</button>
				</td>	 -->
			</tr>
<?php	}
	}
?>


            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page bg-light">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid ">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0 d-nonee" style="font-size: 11px;">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                            <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Statistics </a></li>
                                            <li class="breadcrumb-item active">Medicines Sold</li>
                                        </ol> 
                                    </div>
                                    <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Statistics : <span class="text-secondary"> Medicines    </span> </h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
        
                        
                        <!-- analytics view details   -->
                        <div class="card d-none" >
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                </div>
                                <h4 class="header-title mb-0">Sales Analytics</h4>

                                <div id="cardCollpase1" class="collapse pt-3 show" dir="ltr">
                                    <div id="sales-chart" class="apex-charts"></div>
                                </div> <!-- collapsed end -->
                            </div> <!-- end card-box --> 
                        </div>
                        
                    <!-- Sales  History   -->
                        <div class="row col-12">
                            <div class="col-lg-6 col-md-6 ">
                                 <div class="card-box" >
                                    <h4 class="header-title ">Most Sold Medicines - <span class="text-danger font-weight-bold">Top 5</span> </h4>
                                    <p class="sub-header">
                                    Statistics For This Month - <span class="text-dark font-weight-bold"> <?php echo date('F')?></span>
                                    </p>
        
                                    <div class="table-responsive">
                                        <table class="table table-centered  mb-0" id="tickets-table">
                                            <thead class="thead-dark text-white">
                                                <th>No</th>
                                                <th> Medicine Name</th>
                                                <th> Qty Sold </th>
                                                <th> Total </th>
                                            </thead>

                                            <tbody>
                                           <?php 
                                                $id = 1;
                                                $total_counter = 0;
                                                $price_counter = 0;
                                                $qty_counter = 0;

                                                // search parameter for current month
                                                $get_number = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE YEAR(sales_datetime)=YEAR(CURDATE()) AND MONTH(sales_datetime)=MONTH(CURDATE())
                                                ")or die(mysqli_error($connect_db));
                                               // found, iterate to search
                                               while ($get_each_month = mysqli_fetch_array($get_number)){
                                                  $selected_sale_number = $get_each_month['sales_number'];

                                                //   $get_all_related = mysqli_query($connect_db,"SELECT `medicineId`, SUM(medicineQty) AS `qty_sold`, SUM(medicineTotal) AS `price` FROM `tbl_sales` WHERE `sales_id_number` = '$selected_sale_number' GROUP BY `medicineId` ORDER BY `qty_sold` DESC LIMIT 5 ")or die($connect_db);
                                                 $get_all_related = mysqli_query($connect_db,"SELECT `mid`,  medicine_name, COUNT(medicineQty) AS `qty_sold`,  SUM(medicineTotal) AS `price` FROM tbl_medicines m INNER JOIN `tbl_sales` s ON m.mid = s.medicineId WHERE `sales_id_number` = '$selected_sale_number' GROUP BY `mid` ORDER BY `qty_sold` DESC LIMIT 1")or die($connect_db);
                                                   while ($each_sale = mysqli_fetch_array($get_all_related)) {
                                                       $productId = $each_sale['medicine_name'];
                                                       $total_counter+= $each_sale['qty_sold'];

                                                       $qty_counter+= $each_sale['qty_sold'];
                                                        $price_counter+= $each_sale['price'];
            
                                                    ?>
                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td><?php echo $productId; ?></td>
                                                    <td><?php echo $qty_counter; ?></td>
                                                    <td><?php echo $currency." ".$price_counter; ?></td>
                                                    
                                                </tr>
                                                <?php
                                                $id++;
                                                    }
                                            
                                                
                                               }
                                                ?>
                                        
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                            
                          
                            <div class="col-lg-6 col-md-6">
                                 <div class="card-box" >
                                    <h4 class="header-title">Staff</h4>
                                    <p class="sub-header">
                                    List of your staff
                                    </p>
        
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                        <thead class="text-dark">
                                        <tr>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        </tr>
                                        
                                        </thead>
                                            <tbody>
                                            <?php  
                                            
                                            $getUserInfo = mysqli_query($connect_db,"SELECT * FROM tbl_users join tbl_account_status on tbl_users.user_status = tbl_account_status.asid join tbl_roles on tbl_users.user_type = tbl_roles.rid ORDER BY `user_date_created` DESC")or die(mysqli_error($connect_db));
                                            while($userInfo = mysqli_fetch_array($getUserInfo)){  
                                        
                                            $get_users_fullname = $userInfo['user_firstname']." ".$userInfo['user_lastname'];
                                            $get_users_contact = $userInfo['user_mobileno'];
                                            $get_users_priority = $userInfo['role_name'];
                                            $get_users_status = $userInfo['status_name'];
                                            $get_users_asid = $userInfo['user_status'];
                                            ?>

                                            <tr>
                                            <td>
                                            <span class="ml-0"><?php echo $get_users_fullname;   ?></span>
                                            </td>

                                            <td>
                                            <?php echo $get_users_contact;   ?>
                                            </td>

                                            <td>
                                            <?php echo $get_users_priority;  ?>
                                            </td>

                                            <td>
                                            <?php 
                                            if($get_users_asid === '1'){ ?>
                                                <span class="badge badge-light-danger"><?php echo $get_users_status;   ?></span>
                                            <?php }else{ ?>
                                                <span class="badge btn-info"><?php echo $get_users_status;   ?></span>
                                            <?php } ?>
                                            </td>
                                            
                                            
                                          <?php  }  ?>
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
        
                            
                        </div>
                        <!--- end row -->
                    </div> <!-- container -->

                </div> <!-- content -->
                


    




<?php require_once 'template/footer.client.php';   ?>
<script src="assets/js/jquery-upload.js"></script>

<script type='text/javascript'>
    $(document).ready(function(){   
        
        var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }


        $(".datepicker").datepicker({
            orientation: 'bottom',
            autoclose: true,
        });
      
    });

</script>

<script type="text/javascript">

var options={
    chart:{
        height:380,
        type:"area"
        ,toolbar:{show:!1}
    },
    plotOptions:{
    bar:{horizontal:!1,
    endingShape:"rounded",columnWidth:"55%"}},
    dataLabels:{enabled:!1},
    stroke:{show:!0,width:2,colors:["transparent"]},
    colors:["#f0643b","#56c2d6","#f8cc6b"],
    series:[
        {name:"Net Profit",data:[44,155,57,56,61,58,63,60,66]},
        {name:"Revenue",data:[76,85,101,98,87,165,91,114,94]},
        {name:"Free Cash Flow",data:[35,41,36,26,45,48,52,53,141]}],
        xaxis:{categories:["Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct"]},legend:{offsetY:-10},
        yaxis:{title:{text:"$ (thousands)"}},fill:{opacity:1},
        grid:{row:{colors:["transparent","transparent"],
            opacity:0},borderColor:"#f1f3fa"},tooltip:{y:{formatter:function(e){return"$ "+e+" thousands"}}}
    };


var chart = new ApexCharts(document.querySelector("#sales-chart"), options);
chart.render();




</script>