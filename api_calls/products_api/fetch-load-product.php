<?php require_once '../../db/db.php'; ?>
         
                                        <?php   
                                        
                                        $getProductInfo = mysqli_query($connect_db,"SELECT * FROM tbl_products JOIN categories_tbl on tbl_products.product_category = categories_tbl.category_id ORDER BY tbl_products.tbl_products_id ASC")or die(mysqli_error($connect_db));
                                        while($product_info = mysqli_fetch_array($getProductInfo)){  
                                            
                                            $get_product_id = $product_info['tbl_products_id'];
                                            $get_product_name = $product_info['product_name'];
                                            $get_product_quantity = $product_info['quantity_available'];
                                            $get_selling_price = $product_info['selling_price'];
                                            $get_cost_price = $product_info['cost_price'];
                                            $get_categories = $product_info['category_name'];
                                            $get_expiry= $product_info['expiry_date'];   ?>

                                            <tr>
                                            
                                            <td>
                                            <span class="ml-2"><?php echo $get_product_name;   ?></span>
                                            </td>

                                            <td>
                                            <?php echo $get_product_quantity;   ?>
                                            </td>

                                            <td>
                                            <?php echo $get_cost_price;   ?>
                                            </td>

                                            <td>
                                            <?php echo $get_selling_price;   ?>
                                            </td>

                                            <td>
                                                <span class="badge badge-light-secondary"><?php echo $get_expiry;   ?></span>
                                            </td>

                                           
                                            <td>
                                                        <a class="load-product-button btn btn-info btn-sm" href="javascript:void(0)" data-id="<?php echo $get_product_id; ?>"><i class="mdi mdi-cart-arrow-down mr-2 font-18 vertical-middle"></i>Load</a>
                                            </td>

                                        </tr>


                                      <?php  }
                                        ?>
