  <!-- Edit Modal -->
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Edit Staff User</h4>
                </div>
                <div class="modal-body p-4">
                    <form method="post" id="edit_user_form">
                        <input type="hidden" name="users_idno" id="users_idno">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label text-dark ">First Name</label>
                                    <input type="text" autocomplete="off" class="form-control" name="users_fname" id="users_fname" placeholder="John">
                                </div>
                            </div>

                            <input type="hidden" name="action_status" value='update' id="action_status">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark ">Last Name</label>
                                    <input type="text" autocomplete="off" class="form-control" name="users_lname" id="users_lname" placeholder="Doe">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark ">Username</label>
                                    <input type="text" autocomplete="off" class="form-control" name="users_login" id="users_login"
                                        placeholder="Username">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-4" class="control-label text-dark ">Phone</label>
                                    <input type="tel" autocomplete="off" class="form-control" name="users_mobile" id="users_mobile"
                                        placeholder="0200000000" pattern="[0][0-9]{9}" maxLength="10">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-5" class="control-label text-dark ">Roles</label>
                                    <select class="wide" id="users_role" name="users_role">
                                        <?php $get_roles = mysqli_query($connect_db,"SELECT * FROM `tbl_roles`");
                                                                
                                                                ?>
                                        <option data-display="Select" value="">Nothing</option>
                                        <?php
                                                                while ($each_role = mysqli_fetch_array($get_roles)) { ?>
                                        <option value="<?php  echo $each_role['rid'] ?>">
                                            <?php echo $each_role['role_name']; ?></option>
                                        <?php }
                                                               mysqli_free_result($get_roles);
                                                                ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-6" class="control-label text-dark ">Status</label>
                                    <select class="wide" id="users_status" name="users_status">
                                        <?php $get_status = mysqli_query($connect_db,"SELECT * FROM `tbl_account_status`");
                                                                ?>
                                        <option data-display="Select" value="">Nothing</option>
                                        <?php
                                                                while ($each_status = mysqli_fetch_array($get_status)) { ?>
                                        <option value="<?php  echo $each_status['asid'] ?>">
                                            <?php echo $each_status['status_name']; ?></option>
                                        <?php }
                                                               mysqli_free_result($get_status);
                                                                ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </div> </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect mr-2" data-dismiss="modal">Close</button>
                     <button  id='reset' class="btn btn-danger waves-effect submit-btn mr-2">Reset Password</button>
                    <button   id='update' class="btn btn-info waves-effect waves-light submit-btn">Save Changes</button>


                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->


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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-1" class="control-label text-dark ">Phone No</label>
                                    <input type="tel" autocomplete="off" class="form-control" name="mobile" id="mobile" maxLength="10" pattern="[0][0-9]{9}" placeholder="0200000000">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-5" class="control-label text-dark ">User Role</label>
                                    <select class="wide" id="user_role" name="user_role" required>
                                        <?php 
                                            $get_roles = mysqli_query($connect_db,"SELECT * FROM `tbl_roles`");
                                            ?>
                                        <option data-display="Select">Nothing</option>
                                        <?php
                                            while ($each_role = mysqli_fetch_array($get_roles)) { ?>
                                        <option value="<?php  echo $each_role['rid'] ?>">
                                            <?php echo $each_role['role_name']; ?></option>
                                        <?php }
                                            mysqli_free_result($get_roles);
                                            ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-6" class="control-label text-dark ">Status</label>
                                    <select class="wide" id="user_status" name="user_status" required>
                                        <?php $get_status = mysqli_query($connect_db,"SELECT * FROM `tbl_account_status`");
                                                                ?>
                                        <option data-display="Select">Nothing</option>
                                        <?php
                                                                while ($each_status = mysqli_fetch_array($get_status)) { ?>
                                        <option value="<?php  echo $each_status['asid'] ?>">
                                            <?php echo $each_status['status_name']; ?></option>
                                        <?php }
                                                               mysqli_free_result($get_status);
                                                                ?>
                                    </select>
                                </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label text-dark ">User Name</label>
                                    <input readonly type="text" autocomplete="off" class="form-control" name="username" id="username" placeholder="Will Be Generated">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark ">Password</label>
                                    <input readonly type="text" autocomplete="off" class="form-control" name="passcode" id="passcode" placeholder="Will Be Generated">
                                </div>
                            </div>
                        </div>
                        
                      
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->


    <!-- Logout Modal -->
    <div id="session-logout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Logout Confirmation </h4>
                </div>
                <div class="modal-body p-4">
                    <form method="post" id="confirm-logout" action="logout.php">
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><font class="text-dark font-weight-bold"> <?php echo ucfirst($_COOKIE['u_n']); ?>,</font>
                                    <label for="field-3" class="control-label text-center text-secondary">Are you sure you want to logout your current session?</label>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Yes! Logout</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->