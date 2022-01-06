    <!-- Add Modal -->
    <div id="category-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Add Medicine Category</h4>
                </div>
                
                <div class="modal-body p-4">
                    <form method="post" id="category-form">
                      <input type="hidden" name="category_id" id="category_id" data-id="add"/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label text-dark">Category Name <span class="text-danger">*</span> </label>
                                    <input type="text" autocomplete="off" required class="form-control" name="name" id="name" placeholder="Enter category name" >
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label text-dark">Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Category description"></textarea>
                                </div>
                            </div>
                                    </div>               
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Save Category</button>
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->    
     
     <!-- Edit Modal -->
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info" style="padding: 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Edit Medicine Category</h4>
                </div>
                
                <div class="modal-body p-4">
                    <form method="post" id="edit-category-form">
                      <input type="hidden" name="categoryid" id="categoryid" data-id="edit"/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label text-dark">Category Name <span class="text-danger">*</span> </label>
                                    <input type="text" autocomplete="off" required class="form-control" name="category_name" id="category_name" placeholder="Enter category name" >
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label text-dark">Description</label>
                                    <textarea class="form-control" id="category_description" name="category_description" placeholder="Category description"></textarea>
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
    
  