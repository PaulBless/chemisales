    <!-- Add Modal -->
    <div id="supplier-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Add Supplier </h4>
                </div>

                <div class="modal-body p-4">
                    <form method="post" id="supplier-form">
                      <input type="hidden" name="supplier_id" id="supplier_id" data-id="add"/>
                        
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label text-dark">Supplier Name</label>
                                    <input type="text" autocomplete="off" required class="form-control" name="name" id="name" placeholder="Jecmas Technologies" onkeypress="return acceptLetters(event)">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone" class="control-label text-dark">Phone Number</label>
                                    <input type="text" autocomplete="off" required class="form-control" onkeypress="return isNumberKey(event)" pattern="[0][0-9]{9}" maxLength="10" name="phone" id="phone" placeholder="0555428455" >
                                </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                                    <label for="email" class="control-label text-dark">Supplier E-Mail</label>
                                    <input type="text" autocomplete="off" required class="form-control" name="email" id="email" placeholder="jecmasghana@gmail.com">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="control-label text-dark">Supplier Address</label>
                                    <textarea class="form-control" col="4" id="address" name="address" placeholder="Manhean-Ablekuma, Accra"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info waves-effect waves-light">Save Changes</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div><!-- /.modal -->  
    
   