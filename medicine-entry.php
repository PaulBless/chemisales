<?php  
    // Include Page Resources
    require_once 'session.php'; 

    
    require_once 'db/db.php'; 
    require_once 'template/header.admin.php'; 
    require_once 'template/topnav.admin.php'; 
    require_once 'template/menu.admin.php'; 
    
    

    // Get Settings Currency
    $get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
    $get_currency_item = mysqli_fetch_array($get_currency);
    $currency = $get_currency_item['settings_ans'];

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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item active">Add Medicine</li>
                            </ol>

                            <!-- <button type="button" id="add-single-medicine" class="btn btn-primary float-right"><i class="mdi mdi-plus"></i> Add New Medicine</button> -->
                        </div>
                            <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">New Medicine Entry</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <!-- Add Medicine -->
            <div class="row">
                <div class="col-md-12">
                     <div class="card-box">
                        <form action="" method="post" id="add-medicine" >
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <!-- Medicine Name -->
                                    <div class="form-group mb-3">
                                        <label for="name">Medicine Name: <span class="text-danger">*</span></label>
                                        <input type="text" name="medicine-name" id="medicine-name" placeholder="Abyvita" class="form-control text-dark" required="">
                                    </div>
                                    <!-- Description -->
                                    <div class="form-group mb-3">
                                        <label for="description">Description: <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control text-dark" id="description" name="description" placeholder="Cyprophetadine with B-Complex Syrup" required="">
                                    </div> 
                                   <!-- Cost & Selling Price -->
                                   <div class="row">
                                        <div class="col-md-6">
                                           <div class="form-group mb-3">
                                                <label for="costPrice">Cost or Purchase Price <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend"> <?php echo $currency; ?> </span>
                                                    </div>
                                                    <input type="text" class="form-control text-dark" name="cost-price" id="cost-price" placeholder="25.00" aria-describedby="inputGroupPrepend" required="" onkeypress="return isNumberKey(event)">
                                                </div>
                                            </div>  
                                           
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="sellingPrice">Selling Price <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend"> <?php echo $currency; ?></span>
                                                    </div>
                                                    <input type="text" class="form-control text-dark" name="selling-price" id="selling-price" placeholder="30.00" aria-describedby="inputGroupPrepend" required="" onkeypress="return isNumberKey(event)">
                                                </div>
                                        </div>
                                            
                                        </div>

                                   </div> 
                                    <!-- Expiry Date & Dosage -->
                                   <div class="row">
                                        <div class="col-md-6">
                                           <div class="form-group mb-3">
                                                <label for="expiryDate">Manufactured Date: </label>
                                                <input type="date" class="form-control" name="mfg-date" id="mfg-date" placeholder="" aria-describedby="inputGroupPrepend" >
                                            </div>  
                                        </div>
                                        <!-- Expiry Date--> 
                                        <div class="col-md-6">
                                           <div class="form-group mb-3">
                                                <label for="expiryDate">Expiry Date: <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="expiry-date" id="expiry-date" placeholder="" aria-describedby="inputGroupPrepend" required="">
                                            </div>  
                                        </div>
                                        <div class="col-md-6 d-none">
                                            <div class="form-group mb-3">
                                                <label for="dosage">Dosage</label>
                                                <input type="text" class="form-control text-dark" name="dosage1" id="dosage1" placeholder="10ml 2times daily" aria-describedby="inputGroupPrepend" >
                                            </div>
                                        </div>
                                   </div>                                  
                                
                                </div> 
                                
                                <div class="col-md-6">   
                                    <div class="row">
                                    <!-- Category --> 
                                        <div class="col-md-6">
                                           <div class="form-group mb-3">
                                                <label for="medicineCategory">Medicine Category: <span class="text-danger">*</span></label>
                                                <div class="dropdown bootstrap-select mb-0 dropup">
                                                    <select class="selectpicker" data-style="btn-outline-pink" required id="medicine-category" name="medicine-category">
                                                        <option value="" disabled selected hidden>Nothing</option>
                                                       <?php 
                                                        $get_categories = mysqli_query($connect_db,"SELECT * FROM `tbl_medicine_categories` ORDER BY `med_cat_name` ASC");
                                                        ?>
                                                        <?php
                                                            while ($each_category = mysqli_fetch_array($get_categories)) { ?>
                                                        <option value="<?php  echo $each_category['mcid'] ?>">
                                                            <?php echo $each_category['med_cat_name']; ?></option>
                                                        <?php }
                                                        mysqli_free_result($get_categories);
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>
                                        <!-- Generic Name --> 
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="genericName">Generic Name: <span class="text-danger">*</span></label>
                                                <div class="dropdown bootstrap-select mb-0 dropup">
                                                    <select class="selectpicker" data-style="btn-outline-success" required id="generic-name" name="generic-name">
                                                        <option value="" disabled selected hidden>Nothing</option>
                                                       <?php 
                                                        $get_generics = mysqli_query($connect_db,"SELECT * FROM `tbl_generic_names` ORDER BY `generic_name` ASC");
                                                        ?>
                                                        <?php
                                                            while ($each_generic = mysqli_fetch_array($get_generics)) { ?>
                                                        <option value="<?php  echo $each_generic['genericid'] ?>">
                                                            <?php echo $each_generic['generic_name']; ?></option>
                                                        <?php }
                                                        mysqli_free_result($get_generics);
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                   </div> <!-- End Row <within>-->
                                                
                                    <!-- Supplier Name --> 
                                    <div class="form-group mb-3 d-none">
                                        <label for="supplierName">Supplier Name: </label>
                                            <select class="form-control" id="supplier-name" name="supplier-name">
                                                <option data-display="Select" value="0" >Nothing</option>
                                                <?php 
                                                $get_query = mysqli_query($connect_db,"SELECT * FROM `tbl_suppliers` ORDER BY `supplier_name` ASC");
                                                    ?>
                                                <?php
                                                    while ($each_supplier = mysqli_fetch_array($get_query)) { ?>
                                                <option value="<?php  echo $each_supplier['supplier_id'] ?>">
                                                    <?php echo $each_supplier['supplier_name']; ?></option>
                                                <?php }
                                                    mysqli_free_result($get_query);
                                                    ?>
                                            </select>
                                    </div> 
                                    <!-- dosage -->
                                    <div class="form-group mb-3">
                                        <label for="dosage">Dosage</label>
                                        <input type="text" class="form-control text-dark" name="dosage" id="dosage" placeholder="10ml 2times daily" aria-describedby="inputGroupPrepend" >
                                    </div>

                                    <!-- Manufaturer Name -->
                                    <div class="form-group mb-3">
                                        <label for="brandName">Manufacture or Brand Name: </label>
                                        <input type="text" class="form-control text-dark" name="brand-name" id="brand-name" placeholder="Manufacturer's Name">
                                    </div>

                                    <!-- Medicine Code & Package Size -->
                                   <div class="row">
                                        <div class="col-md-6">
                                           <div class="form-group mb-3">
                                                <label for="packageSize">Weight or Size: </label>
                                                <input type="text" class="form-control text-dark" name="package-size" id="package-size" placeholder="200 ML">
                                            </div>  
                                           
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="medicineCode">Medicine Code:</label>
                                                <input type="text" class="form-control text-dark font-weight-bold" name="medicine-code" value="<?php echo "PS-". mt_rand(10000, 99999); ?>" id="medicine-code" readonly>
                                        </div>
                                            
                                        </div>
                                   </div>  
                                    
                                    
                                </div>

                            </div>
                                
                                <button class="btn btn-pink waves-effect float-right d-none" type="button" name="add-more" id="add-more">+ Add More </button>
                                                        
                            <div class="row d-flex justify-content-center">
                                <button class="btn btn-success waves-effect text-center mr-2" type="submit" name="save" id="save">Save Medicine </button>
                                <button class="btn btn-secondary waves-effect" type="button" onclick="return window.location.href='admin.dashboard.php'">Cancel </button>
                            </div>

                        </form>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

            <!-- Add Medicine Using Bootstrap Table Format, to be able to add more medicines at a single time -->
            <div class="row d-none">
                <div class="col-md-12">
                    <div class="card-box">
                        <form action="" method="post" id="add-products-form">
                            <table class="table table-striped m-0 table-centered table-responsive nowrap w-100" id="tickets-table">
                                <thead>
                                    <tr style="color: #145388;">
                                        <th>Medicine Name</th>
                                        <th>Description</th>
                                        <th>Cost Price</th>
                                        <th>Selling Price</th>
                                        <th>Expiry Date</th>
                                        <th>Dosage</th>
                                        <th>Generic Name</th>
                                        <th>Category</th>
                                        <th>Supplier Name</th>
                                        <th>Brand Name</th>
                                        <th>Package Size</th>
                                        <th>Medicine Code</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                        <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="cost_price_boxes[]" required>
                                        </td>

                                         <td>
                                         <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="cost_price_pcs[]"
                                                required>
                                        </td>
                                        <td>
                                        <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="selling_price_boxes[]"
                                                required>
                                        </td>

                                         <td>
                                         <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="selling_price_pcs[]"
                                                required>
                                        </td>

                                        <td>
                                        <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="quantity_avail_box[]"
                                                required>
                                        </td>

                                        <td>
                                        <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="quantity_avail_pcs[]"
                                                required>
                                        </td> 
                                        
                                        <td>
                                        <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="quantity_avail_pcs[]"
                                                required>
                                        </td> 
                                        
                                        <td>
                                        <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="quantity_avail_pcs[]"
                                                required>
                                        </td>   
                                        
                                        <td>
                                        <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="quantity_avail_pcs[]"
                                                required>
                                        </td> 
                                        
                                        <td>
                                        <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="quantity_avail_pcs[]"
                                                required>
                                        </td>
                                        
                                        <td>
                                        <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="quantity_avail_pcs[]"
                                                required>
                                        </td> 
                                        
                                        <td>
                                        <input type="text" autocomplete="off" onkeypress="return isNumberKey(event)" class="form-control products" name="quantity_avail_pcs[]"
                                                required>
                                        </td>

                                        <td>
                                        <button type="button" name="add" id="add" class="btn btn-success">+</button>
                                        </td>

                                    </tr>
                                </tbody>

                            </table> 
                              
                            <div class="row d-flex justify-content-center">
                                <button class="btn btn-success waves-effect text-center" type="submit" name="save-all" id="save-all">Save All Medicines </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div> <!-- container -->

    </div> <!-- content -->


    <?php require_once 'template/footer.client.php';   ?>

    
    <script type='text/javascript'>
    
    $(document).ready(function() {

        
        // saves new medicine
        $('#add-medicine').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();

                $.ajax({
                    url: 'api_calls/medicine_api/add.medicine.php',
                    type: 'POST',
                    data: formdata,
                    success: function(res) {
                        if(res === 'success')
                        {
                        swal.fire(
                            'Great!', 
                            'Medicine ' + $('#medicine-name').val() + ' added successfully..', 
                            'success').then(function() {
                            window.location.href = 'medicine.entry.php'
                            clearForm();
                        });
                        }
                        else if (res === 'exist')
                        {
                            swal.fire(
                                'Error!', 
                                'This medicine is already added or exists', 
                                'error').then(function() {
                                window.location.href = 'medicine.entry.php'
                            });
                        }
                        else{
                            Swal.fire(
                            'Ooops',
                            'Something went wrong while adding record',
                            'error').then(function() {
                                window.location.href = 'medicine.entry.php'
                            });
                        }
                      
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

       

    });

function clearForm(){
    $("#medicine-category").val(null).trigger("change");  //reset dropdown
    $("#generic-name").val(null).trigger("change");  //reset dropdown
    $("#dosage").val('');
    $("#package-size").val('');
    $("#brand-name").val('');
    $("#medicine-name").val('');
    $("#description").val('');
    $("#cost-price").val('');
    $("#selling-price").val('');
    $("#mfg-date").val('');
    // $("#supplier-name").selectedIndex = 0;
}
  
    </script>