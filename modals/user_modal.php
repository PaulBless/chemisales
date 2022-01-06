
    <!-- Show User Sales Modal -->
     <div id="sales-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" id="my-sales">
            <div class="modal-content ">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title "><?php echo $users_fullname;?> - Your Sales For Today <span class="text-white">(<?php echo date('d M, Y');?>)</span></h4>
                </div>
                <div class="modal-body p-4 d-flex justify-content-center align-items-center">
                  
                	<div class="row">
                        <div class="span5">
                            <table class="table table-striped table-bordered table-condensed" width="100%" id="my-sales-tbody">
                               
                            </table>
                        </div>
	                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->


    <!-- Change Password Modal -->
    <div id="update-password-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatepassModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog" id="update-pass">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="updatepassModalLabel">Change Your Password</h4>
                </div>
                <div class="modal-body p-4">
                    <form method="post" id="update-password-form">
                        <div class="row d-none" >
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="field-1" class="control-label text-dark">User ID</label>
                                    <input type="text" autocomplete="off" class="form-control" name="userid" id="userid" value="<?php echo $userid; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark">Username</label>
                                    <input type="text" autocomplete="off" class="form-control" name="username" id="username" value="<?php echo $loginid; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="current-password" class="control-label text-dark">Your Full Name</label>
                                    <input type="text" autocomplete="off" class="form-control" name="user-fname" id="user-fname" value="<?php echo $users_fullname;  ?>" readonly>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="current-password" class="control-label text-dark">Current Password</label>
                                    <input type="password" autocomplete="off" class="form-control" name="current-password" id="current-password"
                                        placeholder="Enter Current Password" required='required'>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="new-password" class="control-label text-dark">New Password</label>
                                    <input type="password" autocomplete="off" class="form-control" name="new-password" id="new-password"
                                        placeholder="Enter New Password" required='required'>
                                        <small id="pass_strength" data-status=''></small>

                                </div>
                            </div>
                        </div>       
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="confirm-password" class="control-label text-dark">Confirm New Password</label>
                                    <input type="password" autocomplete="off" class="form-control" name="confirm-password" id="confirm-password"
                                        placeholder="Confirm New Password" required='required'>
                                        <small id="pass_match" data-status=''></small>

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
    </div> <!-- /.modal --> 


    <!-- Logout Modal -->
    <div id="logout-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog logout-mod" >
            <div class="modal-content" >
                <div class="modal-header bg-info" style="padding: 10px; ">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Confirm Logout</h4> 
                </div>
                <form method="post" id="confirm-logout" action="logout.php">
                <div class="modal-body p-4">
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">Hi,
                                    <label for="field-3" class="control-label text-dark"><?php echo $users_fullname; ?>!</label><br> 
                                    <span class="text-center">Are you sure you want to logout your current session?</span>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Yes! Logout</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<!-- /.modal -->


  <!-- Delete Modal-->
    <div class="modal" tabindex="-1" role="dialog" id="delete-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>