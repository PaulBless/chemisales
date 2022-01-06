<?php  require_once 'db/db.php'; ?>

<?php  require_once 'header/admin-header.php';  ?>

<?php  require_once 'sidebar/admin-sidebar.php';  ?>

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
                                       
                                    </div>
                                          <h4 class="page-title font-weight-bold" style="letter-spacing: 1px;">
Products</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                 <div class="card-box" >
                                    
                                    <h4 class="header-title mb-4 text-dark">Load Products</h4>

                                    <table class="table table-hover  m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                        <thead class="bg-info text-dark">
                                        <tr>
                                          
                                            <th> Name</th>                                        
                                            <th>Quantity Aval.</th>
                                            <th>Cost Price</th>
                                            <th>Selling Price</th>
                                            <th>Expiry Date</th>
                                            <th>Load</th>
                                            
                                        </tr>
                                        </thead>

                                        <tbody id="fetch-products">
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->    
                        
                    </div> <!-- container -->

                </div> <!-- content -->
                
                <!-- Load Modal -->
                <div id="load-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info">
                                                    <h4 class="modal-title text-center">Load Product</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <form method="post" id="edit_new_product">
                                                    <input type="hidden" name="product_id" id="product_id">
                                                    <input type="hidden" name="old_quantity" id="old_quantity">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label text-dark">Quantity Adding</label>
                                                                <input required="required" type="number" min-length="0" class="form-control" name="new_quantity" id="new_quantity" placeholder="Enter quantity">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-2" class="control-label text-dark">Expiry Date</label>
                                                                <input required="required" type="text" class="form-control datepicker" name="new_expiry" id="new_expiry" placeholder="Expiry date">
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


                                   



                <?php require_once 'footer/admin-footer.php';   ?>

                <script type='text/javascript'>
                $(document).ready(function(){
                readProducts(); /* it will load products when document loads */  
                $(".datepicker").datepicker({ orientation: 'bottom',autoclose: true,});
                $('select').niceSelect();
            
                    $('#edit_new_product').submit(function(e){
                    e.preventDefault();
                    var formdata = $(this).serialize();

                    $.ajax({
                        url:'api_calls/products_api/edit-load-product.php',
                        type: 'POST',
			       	    data: formdata,
                        success:function(res){
                        
                        if(res === "success"){
                        Swal.fire(
                        'Good job!',
                        'All Products Loaded Successfully',
                        'success'
                        ).then(function(){readProducts()});

                        }else{
                            Swal.fire(
                        'Ooops',
                        'Something Went Wrong',
                        'error'
                        ).then(function(){readProducts()});
                        }

                           

                        $('#load-modal').modal('hide');
                        $('#product_id').val('');
                        $('#new_quantity').val('');
                        $('#new_expiry').val('');
                        $('.datepicker').removeClass('hasDatepicker').datepicker({orientation:'bottom',autoclose: true,})
                        
                        },
                        error:function(res){
                            console.log(res);
                        }

                    });

                })



                $(document).on('click','.load-product-button',function(e) {
                    var productId = $(this).data('id');
                    $.ajax({
                        url:'api_calls/products_api/product-details.php',
                        type: 'POST',
			       	    data: 'productId='+productId,
                        dataType: 'json' ,
                        success:function(res){
                            $('#product_id').val(res.product_id);
                            $('#old_quantity').val(res.product_quantity);
                            
                            $('#load-modal').modal('show');
                            $('.datepicker').removeClass('hasDatepicker').datepicker({orientation:'bottom',autoclose: true,})
                        },
                        error:function(res){
                            console.log(res);
                        }    
                    });
                });
   
     
            });
            
            function readProducts(){
                $('#fetch-products').load('api_calls/products_api/fetch-load-product.php');
            }


    </script>