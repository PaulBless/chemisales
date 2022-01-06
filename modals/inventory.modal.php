<!-- Edit Modal -->
<div id="edit-ingredient-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Edit Ingredient</h4>
                </div>
                <div class="modal-body p-4">
                    <form method="post" id="edit_new_ingredient">
                        <input type="hidden" name="ingredient_id" id="ingredient_id">
                        <div class="row">
                           
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label text-dark">Ingredient Name</label>
                                    <input type="text" autocomplete="off" class="form-control" name="ingredient_name" id="ingredient_name"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                       
                        <br>
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label text-dark">Cost Price <span class="text-danger">(Box)</span></label>
                                    <input type="text" autocomplete="off" class="form-control" name="cost_price_box" id="cost_price_box"
                                        placeholder="">
                                </div>
                            </div>
                        
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-4" class="control-label text-dark">Cost Price <span class="text-danger">(Pcs)</span></label>
                                    <input type="text" autocomplete="off" class="form-control" name="cost_price_pcs" id="cost_price_pcs"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Quantity Available (Box)</label>
                                    <input type="text" autocomplete="off" class="form-control" name="quantity_available_box"
                                        id="quantity_available_box" placeholder="">
                                </div>
                            </div>
                        
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Quantity Available (Pcs)</label>
                                    <input type="text" autocomplete="off" class="form-control" name="quantity_available_pcs"
                                        id="quantity_available_pcs" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label text-dark">Expiry</label>
                                    <input type="text" autocomplete="off" class="form-control datepicker" name="expiry" id="expiry"
                                        placeholder="">
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