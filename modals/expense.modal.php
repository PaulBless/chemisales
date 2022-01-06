<!-- Add Modal -->
    <div id="add-expense-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Add Expense</h4>
                </div>
                <div class="modal-body p-4">
                    <form method="post" id="add-expense-form">
                        <p>Submiting this form will add data to your expense records.</p>
                        
                        <?php 
                            $random = mt_rand(1000,9999);
                            $expenseId = "E/". $random; 
                            $expenseDate = date("d-M-Y");
                        ?>
            
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Expense ID</label>
                                    <input type="text" autocomplete="off" class="form-control" name="expenseId" id="expenseId" value="<?php echo $expenseId; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Expense Date <span class="text-danger">*</span> </label>
                                    <input type="text" autocomplete="off" class="form-control datepicker" name="expenseDate"
                                        id="expenseDate" value="" required>
                                </div>
                            </div>
                        </div>

                        <br>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="expenseAmount">Expense Amount <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="expenseAmount" id="expenseAmount" onkeypress="return isNumberKey(event)" placeholder="750" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark">Expense Details & Description <span class="text-danger">*</span> </label>
                                    <textarea autocomplete="off" id="expenseDetails" name="expenseDetails" class="form-control" rows="3" placeholder="Amount paid for the painting of the shop " required></textarea>
                                </div>
                            </div>
                        </div>

                        
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success waves-effect waves-light">Save Expense</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
    
    <!-- Exit Modal -->
    <div id="edit-expense-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Edit Expense</h4>
                </div>
                <div class="modal-body p-4">
                    <form method="post" id="edit-expense-form">
                        <input type="hidden" name="expense_id" id="expense_id">
                        <p>Submiting this form will update the details of expense record.</p>
                        
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Expense ID</label>
                                    <input type="text" autocomplete="off" class="form-control" name="expense_code"
                                        id="expense_code" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Expense Date</label>
                                    <input type="text" autocomplete="off" class="form-control datepicker" name="expense_date"
                                        id="expense_date" required>
                                </div>
                            </div>
                        </div>

                        <br>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark">Expense Amount</label>
                                    <input type="text" autocomplete="off" class="form-control" name="expense_amount" id="expense_amount"
                                        placeholder="1500" onkeypress="return isNumberKey(event);" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark">Expense Details & Description</label>
                                    <textarea id="expense_details" name="expense_details" class="form-control" rows="3" placeholder="Payment of Workers Salary for the month of May" autocomplete="off" required></textarea>
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