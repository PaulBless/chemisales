  <!-- Edit Modal -->
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Edit Medicine </h4>
                </div>
                
                <div class="modal-body p-4">
                    <form method="post" id="add-medicine-form" class="needs-validation no">
                    <input type="hidden" name="medicine_id" id="medicine_id" >
                        
                            <!-- Medicine Name -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="name">Medicine Name: <span class="text-danger">*</span></label>
                                        <input type="text" name="medicine_name" id="medicine_name" placeholder="Abyvita" class="form-control text-dark" required>
                                    </div>
                                </div> 
                            </div>

                            <!-- Description -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                            <label for="description">Description: <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control text-dark" name="medicine_description" id="medicine_description" placeholder="Cyprophetadine with B-Complex Syrup" required="">
                                    </div> 
                                </div>
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
                                                        <input type="number" class="form-control text-dark" name="cost_price" id="cost_price" placeholder="25.00" aria-describedby="inputGroupPrepend" required="">
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
                                                    <input type="number" class="form-control text-dark" name="selling_price" id="selling_price" placeholder="30.00" aria-describedby="inputGroupPrepend" required="">
                                                </div>
                                </div>
                            </div>   

                            <!-- Category & Generic Input --> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="medicineCategory">Medicine Category: <span class="text-danger">*</span></label>
                                        <div class="dropdown bootstrap-select mb-0 dropup">
                                                        <select class="selectpicker" data-style="btn-outline-pink" required id="medicine_category" name="medicine_category">
                                                            <option value="" disabled selected hidden>Nothing</option>
                                                        <?php 
                                                            $get_categories = mysqli_query($connect_db,"SELECT * FROM `tbl_medicine_categories`");
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
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="genericName">Generic Name: <span class="text-danger">*</span></label>
                                        <div class="dropdown bootstrap-select mb-0 dropup">
                                                        <select class="selectpicker" data-style="btn-outline-success" required id="generic_name" name="generic_name">
                                                            <option value="" disabled selected hidden>Nothing</option>
                                                        <?php 
                                                            $get_generics = mysqli_query($connect_db,"SELECT * FROM `tbl_generic_names`");
                                                            ?>
                                                        <?php
                                                            while ($each_generic = mysqli_fetch_array($get_generics)) { ?>
                                                        <option value="<?php  echo $each_generic['genericid'] ?>">
                                                            <?php echo $each_generic['generic_name']; ?></option>
                                                        <?php }
                                                            mysqli_free_result($get_roles);
                                                            ?>
                                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Expiry Date & Package Size -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                                <label for="packageSize">Package Size: </label>
                                                <input type="text" class="form-control" name="package_size" id="package_size" placeholder="200 ML" aria-describedby="inputGroupPrepend" required="">
                                            </div>  
                                           
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="expiryDate">Expiry Date: <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="expiry_date" id="expiry_date" placeholder="" aria-describedby="inputGroupPrepend" required="">
                                    </div> 
                                </div>
                            </div>  

                             <!-- Expiry Date & Dosage -->
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="dosage">Dosage</label>
                                        <input type="text" class="form-control" name="medicine_dosage" id="medicine_dosage" placeholder="10ml 2times daily" aria-describedby="inputGroupPrepend" required="">
                                    </div>
                                </div>
                            </div>
                                    
                            </div>
                        </div>        

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary waves-effect text-center mr-3" type="submit" name="save" id="save">Save Medicine </button>
                        <button class="btn btn-secondary waves-effect" type="button" data-dismiss="modal">Cancel </button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->   

    
    <!-- modal test -->
    <div id="edit-medicine-modal" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true" style="padding-right: 17px; ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center font-weight-bold">Edit Medicine</h4>
                </div>
                <div class="modal-body p-4">
                    <form method="post" id="edit_medicine">
                        <input type="hidden" name="medicine-id" id="medicine-id" >
                        <input type="hidden" name="medicine-code" id="medicine-code" >
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark">Medicine Name <span class="text-danger">(*)</span></label>
                                    <input type="text" autocomplete="off" class="form-control" name="medicine-name" id="medicine-name" placeholder="Abyvita" required>
                                </div>
                            </div>
                        </div>   
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark">Description <span class="text-danger">(*)</span></label>
                                    <input type="text" autocomplete="off" class="form-control" name="description" id="description" placeholder="Cyprophetadine with B-Complex Syrup" required>
                                </div>
                            </div>
                        </div>
                       
                        <br>
                       
                       <!-- cost & selling price -->
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label text-dark">Cost / Purchase Price <span class="text-danger">(*)</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend"> <?php echo $currency; ?></span>
                                        </div>
                                        <input type="text" onkeypress="return isNumberKey(event);" class="form-control text-dark" name="cost-price" id="cost-price" placeholder="25.00" aria-describedby="inputGroupPrepend" required="">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label text-dark">Selling Price <span class="text-danger">(*)</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend"> <?php echo $currency; ?></span>
                                        </div>
                                           <input type="text" onkeypress="return isNumberKey(event);" class="form-control text-dark" name="selling-price" id="selling-price" placeholder="30.00" aria-describedby="inputGroupPrepend" required="">
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="medicineCategory">Medicine Category: <span class="text-danger">*</span></label>
                                        <div class="dropdown bootstrap-select mb-0 dropup">
                                                        <select class="selectpicker" data-style="btn-outline-pink" id="medicine-category" name="medicine-category">
                                                            <option value="" disabled selected hidden>Nothing</option>
                                                        <?php 
                                                            $get_categories = mysqli_query($connect_db,"SELECT * FROM `tbl_medicine_categories`");
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
                                                        
                            <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="genericName">Generic Name: <span class="text-danger">*</span></label>
                                        <div class="dropdown bootstrap-select mb-0 dropup">
                                            <select class="selectpicker" data-style="btn-outline-success" id="generic-name" name="generic-name" >
                                                            <option value="" disabled selected hidden>Nothing</option>
                                                        <?php 
                                                            $get_generics = mysqli_query($connect_db,"SELECT * FROM `tbl_generic_names`");
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
                        </div>
                        

                        <div class="row">                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label text-dark">Manufactured Date: </label>
                                    <input type="date" class="form-control text-dark" name="mfg-date" id="mfg-date" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label text-dark">Expiry Date: <span class="text-danger">(*)</span></label>
                                    <input type="date" class="form-control text-dark" name="expiry-date" id="expiry-date" aria-describedby="inputGroupPrepend" required="">
                                </div>
                            </div>
                        </div>  
                        
                        <div class="row">
                            <!-- Supplier Name --> 
                            <div class="col-md-6 d-none">
                                <div class="form-group mb-3">
                                        <label for="supplierName">Supplier Name: </label>
                                        <select class="form-control" id="supplier-name" name="supplier-name">
                                                <option data-display="Select" value="0" >Nothing</option>
                                                <?php 
                                                $get_query = mysqli_query($connect_db,"SELECT * FROM `tbl_suppliers`");
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
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label text-dark">Package Size: </label>
                                    <input type="text" class="form-control text-dark" name="package-size" id="package-size" placeholder="200 ML" aria-describedby="inputGroupPrepend" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Manufaturer Name -->
                                <div class="form-group mb-3">
                                    <label for="brandName">Brand Name: </label>
                                    <input type="text" class="form-control text-dark" name="brand-name" id="brand-name" placeholder="Manufacturer's Name">
                                </div>
                            </div>
                                    
                        </div>   


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Dosage</label>
                                    <input type="text" autocomplete="off" class="form-control text-dark" name="med-dosage" id="dosage" placeholder="10ml, 2times daily">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Batch Number</label>
                                    <input type="text" autocomplete="off" class="form-control text-dark" name="batch" id="batch" placeholder="KPY865D">
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                </form>
                </div>
                
            </div>
        </div>
    </div>