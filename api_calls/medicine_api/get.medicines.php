<?php require_once '../../db/db.php'; ?>
         
                                        <?php   
                                        
                                        $query_medicines = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` JOIN `tbl_medicine_categories` ON `tbl_medicines`.`category_id` = `tbl_medicine_categories`.`mcid` JOIN `tbl_generic_names` ON `tbl_medicines`.`generic_id` = `tbl_generic_names`.genericid ORDER BY `medicine_name` ASC")OR DIE(mysqli_error($connect_db));
                                        while($userInfo = mysqli_fetch_array($query_medicines)){  
                                            
                                            $get_users_Id = $userInfo['uid'];
                                            $get_users_userId = $userInfo['user_code'];
                                            $get_users_fullname = $userInfo['user_firstname']." ".$userInfo['user_lastname'];
                                            $get_users_username = $userInfo['user_loginid'];
                                            $get_users_contact = $userInfo['user_mobileno'];
                                            $get_users_priority = $userInfo['role_name'];
                                            $get_users_status = $userInfo['status_name'];
                                            $get_users_last_login= $userInfo['user_date_created'];   ?>

                                            <tr>
                                            <td><b>#<?php echo $get_users_userId;   ?></b></td>
                                            <td>
                                            <span class="ml-2"><?php echo $get_users_fullname;   ?></span>
                                            </td>

                                            <td>
                                            <?php echo $get_users_username;   ?>
                                            </td>

                                            <td>
                                            <?php echo $get_users_contact;   ?>
                                            </td>

                                            <td>
                                            <?php echo $get_users_priority;   ?>
                                            </td>

                                            <td>
                                                <span class="badge badge-light-secondary"><?php echo $get_users_status;   ?></span>
                                            </td>

                                            <td>
                                                <span class="badge badge-success"><?php echo $get_users_last_login ;  ?></span>
                                            </td>   

                                            <td>
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item edit-user-button" href="javascript:void(0)" data-id="<?php echo $get_users_Id; ?>"><i class="mdi mdi-pencil mr-2 text-primary font-18 vertical-middle" ></i>Edit User</a>
                                                        <a class="dropdown-item delete-user-button" href="javascript:void(0)" data-id="<?php echo $get_users_Id; ?>"><i class="mdi mdi-delete mr-2 text-danger font-18 vertical-middle"></i>Remove User</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>


                                      <?php  }
                                        ?>
                                      