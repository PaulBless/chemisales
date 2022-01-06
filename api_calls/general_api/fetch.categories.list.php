<?php require_once '../../db/db.php'; ?>
         
                                        <?php   
                                        
                                        $get_categories_query = mysqli_query($connect_db,"SELECT * FROM `tbl_medicine_categories` ORDER BY `med_cat_name` ASC")or die(mysqli_error($connect_db));
                                        while($categoryLists = mysqli_fetch_array($get_categories_query)){  
                                            // read db table details
                                            $get_category_Id = $categoryLists['mcid'];
                                            $get_category_name = $categoryLists['med_cat_name'];
                                            $get_category_desc = $categoryLists['med_cat_comment'];
                           
                                          ?>

                                            <tr>
                                            
                                            <td><?php echo $get_category_name;   ?></td>

                                            <td><?php echo $get_category_desc;   ?></td>

                                          <!-- Action Buttons -->
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-top">
                                                        <a id="btnedit" class="dropdown-item edit-button" href="javascript:void(0)" data-id="<?php echo $get_category_Id; ?>"><i class="mdi mdi-pencil mr-1 text-primary font-18 vertical-middle" ></i>Edit Category </a>
                                                        <a class="dropdown-item delete-button" href="javascript:void(0)" data-id="<?php echo $get_category_Id; ?>"><i class="mdi mdi-delete mr-1 text-danger font-18 vertical-middle"></i>Delete Category</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>


                                    <?php 
                                 }
                               ?>
                                      