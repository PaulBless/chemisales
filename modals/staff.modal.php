  <!-- Add Modal -->
    <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Add Staff User </h4>
                </div>
                
                <div class="modal-body p-4">
                    <form method="post" id="add_new_user">
                        <input type="hidden" name="users_id" id="users_id" value="<?php echo mt_rand(1000, 9999); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label text-dark ">First Name</label>
                                    <input type="text" autocomplete="off" class="form-control" name="fname" id="fname" placeholder="John">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark ">Last Name</label>
                                    <input type="text" autocomplete="off" class="form-control" name="lname" id="lname" placeholder="Doe">
                                </div>
                            </div>
                        </div>

                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label text-dark ">Phone No</label>
                                    <input type="text" onkeypress="return isNumberKey(event);" autocomplete="off" class="form-control" name="mobile" id="mobile" maxLength="10" pattern="[0][0-9]{9}" placeholder="0201234567">
                                </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="field-6" class="control-label text-dark ">User Role</label>
                                <div class="dropdown bootstrap-select mb-0 dropup">
                                    <select class="wide border-info" required id="user_role" name="user_role">
                                        <option value="" data-display="Select" disabled selected hidden>Nothing</option>
                                            <?php 
                                            $get_user_roles = mysqli_query($connect_db,"SELECT * FROM `tbl_roles`");
                                            ?>
                                            <?php
                                            while ($each_role = mysqli_fetch_array($get_user_roles)) { ?>
                                                <option value="<?php  echo $each_role['rid'] ?>">
                                                <?php echo $each_role['role_name']; ?></option>
                                            <?php }
                                                mysqli_free_result($get_user_roles);
                                            ?>
                                    </select>
                                </div>
                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="field-6" class="control-label text-dark ">Status</label>
                                    <div class="dropdown bootstrap-select mb-0 dropup">
                                        <select class="wide border-primary" required id="user_status" name="user_status">
                                            <optio value="" data-display="Select" disabled selected hidden>Nothing</optio>
                                                <?php 
                                                $get_categories = mysqli_query($connect_db,"SELECT * FROM `tbl_account_status`");
                                                ?>
                                                <?php
                                                while ($each_category = mysqli_fetch_array($get_categories)) { ?>
                                                    <option value="<?php  echo $each_category['asid'] ?>">
                                                    <?php echo $each_category['status_name']; ?></option>
                                                <?php }
                                                    mysqli_free_result($get_categories);
                                                ?>
                                        </select>
                            </div>
                                   
                                </div>
                            </div>
                        </div>
                        
                      
                       <div class="row text-center mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                <p for="hint" class="control-label text-danger font-weight-lighter">Remember: <span class="text-dark"> Username & Password is System Generated </span> </p>
                                </div>
                            </div>
                        </div> 
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success waves-effect waves-light">Save Staff</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<!-- /.modal --> 

 <!-- Edit Modal -->
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Edit Staff User </h4>
                </div>
                
                <div class="modal-body p-4">
                    <form method="post" id="edit_staff_user">
                        <input type="hidden" name="users_idno" id="users_idno">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label text-dark ">First Name</label>
                                    <input type="text" autocomplete="off" class="form-control" name="firstname" id="firstname" placeholder="John">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark ">Last Name</label>
                                    <input type="text" autocomplete="off" class="form-control" name="lastname" id="lastname" placeholder="Doe">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="action_status" id="action_status" value="update">
                       
                       <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-1" class="control-label text-dark ">Phone No</label>
                                    <input type="text" onkeypress="return isNumberKey(event);" autocomplete="off" class="form-control" name="mobileno" id="mobileno" maxLength="10" pattern="[0][0-9]{9}" placeholder="0200000000">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-1" class="control-label text-dark ">User Name</label>
                                    <input type="text" autocomplete="off" class="form-control text-dark" name="users_loginid" id="users_loginid" readonly>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-1" class="control-label text-dark ">User ID</label>
                                    <input type="text" autocomplete="off" class="form-control text-pink" name="users_code" id="users_code" readonly>
                                </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="field-6" class="control-label text-dark ">User Role</label>
                                <div class="dropdown bootstrap-select mb-0 dropup">
                                    <select class="wide border-info" id="users_role" name="users_role" required>
                                        <option value="" disabled selected hidden>Nothing</option>
                                            <?php 
                                            $get_user_roles = mysqli_query($connect_db,"SELECT * FROM `tbl_roles`");
                                            ?>
                                            <?php
                                            while ($each_role = mysqli_fetch_array($get_user_roles)) { ?>
                                                <option value="<?php  echo $each_role['rid'] ?>">
                                                <?php echo $each_role['role_name']; ?></option>
                                            <?php }
                                                mysqli_free_result($get_user_roles);
                                            ?>
                                    </select>
                                </div>
                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="field-6" class="control-label text-dark ">Status</label>
                                    <div class="dropdown bootstrap-select mb-0 dropup">
                                        <select class="wide border-pink" required id="users_status" name="users_status">
                                            <option value="" disabled selected hidden>Nothing</option>
                                                <?php 
                                                $get_categories = mysqli_query($connect_db,"SELECT * FROM `tbl_account_status`");
                                                ?>
                                                <?php
                                                while ($each_category = mysqli_fetch_array($get_categories)) { ?>
                                                    <option value="<?php  echo $each_category['asid'] ?>">
                                                    <?php echo $each_category['status_name']; ?></option>
                                                <?php }
                                                    mysqli_free_result($get_categories);
                                                ?>
                                        </select>
                            </div>
                                   
                                </div>
                            </div>
                        </div>
                      
                       
                </div>

                <div class="modal-footer">
                    <button   id='update' class="btn btn-info waves-effect waves-light submit-btn mr-2">Save Changes</button>
                    <!-- <button  id='reset' class="btn btn-danger waves-effect submit-btn mr-2">Reset Password</button> -->
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>

                </div>
                </form>
            </div>
        </div>
    </div>
<!-- /.modal -->
