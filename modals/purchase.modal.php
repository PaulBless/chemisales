<!-- Add Modal -->
<div id="add-purchase-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Add Purchase</h4>
                </div>
                <div class="modal-body p-4">
                    <form method="post" id="add-purchase-form">
                        <p>Submiting this form will add data to your purchase records.</p>
                        
                        <?php 
                            $random = mt_rand(100000,999999);
                            $purchaseId = "P/". $random; 
                            $purchaseDate = date("d-M-Y");
                        ?>
            
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Purchase ID</label>
                                    <input type="text" autocomplete="off" class="form-control" name="purchaseId"
                                        id="purchaseId" value="<?php echo $purchaseId; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Purchase Date <span class="text-danger">*</span> </label>
                                    <input type="text" autocomplete="off" class="form-control datepicker" name="purchaseDate"
                                        id="purchaseDate"  required>
                                </div>
                            </div>
                        </div>

                        <br>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="purchaseAmount">Purchase Amount <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="purchaseAmount" id="purchaseAmount" onkeypress="return isNumberKey(event)" placeholder="eg. 550" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark">Purchase Details & Description <span class="text-danger">*</span> </label>
                                    <textarea id="purchaseDetails" autocomplete="off" class="form-control" name="purchaseDetails" rows="3" placeholder="Purchase of Medicines for Stocking." required></textarea>
                                </div>
                            </div>
                        </div>

                        
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success waves-effect waves-light">Save Purchase</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
    
    <!-- Exit Modal -->
    <div id="edit-purchase-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Edit Purchase</h4>
                </div>
                <div class="modal-body p-4">
                    <form method="post" id="edit-purchase-form">
                        <input type="hidden" name="purchase_id" id="purchase_id">
                        <p>Submiting this form will update the details of purchase record.</p>
                        
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Purchase ID</label>
                                    <input type="text" autocomplete="off" class="form-control" name="purchase_code"
                                        id="purchase_code" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Purchase Date</label>
                                    <input type="text" autocomplete="off" class="form-control datepicker" name="purchase_date"
                                        id="purchase_date" required>
                                </div>
                            </div>
                        </div>

                        <br>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark">Purchase Amount</label>
                                    <input type="text" autocomplete="off" class="form-control" name="purchase_amount" id="purchase_amount"
                                        placeholder="500.00" onkeypress="return isNumberKey(event);" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark">Purchase Details & Description</label>
                                    <!-- <textarea type="text" autocomplete="off" class="form-control" name="purchase_details" id="purchase_details" placeholder="Details of Purchase" rows="4" required> </textarea> -->
                                    <textarea id="purchase_details" autocomplete="off" class="form-control" rows="3" placeholder="Purchase of Medicine Items Needed for Stock" required></textarea>
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