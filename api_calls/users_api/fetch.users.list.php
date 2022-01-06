<?php require_once '../../db/db.php'; ?>
         
                                        <?php   
                                        
                                        $get_user_info_query = mysqli_query($connect_db,"SELECT * FROM `tbl_users` JOIN `tbl_account_status` ON `tbl_users`.`user_status` = `tbl_account_status`.`asid` JOIN `tbl_roles` ON `tbl_users`.`user_type` = `tbl_roles`.`rid` ORDER BY `user_date_created`, `user_firstname` ASC")or die(mysqli_error($connect_db));
                                        while($userInfo = mysqli_fetch_array($get_user_info_query)){  
                                            
                                            $get_users_Id = $userInfo['uid'];
                                            $get_users_code = $userInfo['user_code'];
                                            $get_users_fullname = $userInfo['user_firstname']." ".$userInfo['user_lastname'];
                                            $get_users_loginid = $userInfo['user_loginid'];
                                            $get_users_passcode = $userInfo['user_passcode'];
                                            $get_users_mobile = $userInfo['user_mobileno'];
                                            $get_users_priority = $userInfo['role_name'];
                                            $get_users_status = $userInfo['status_name'];
                                            $get_users_regdate= $userInfo['user_date_created'];   
                                          ?>

                                            <tr>
                                            
                                            <td class="text-dark font-weight-bold"><?php echo $get_users_code;   ?></td>
                                            
                                            <td><span class="ml-2"><?php echo $get_users_fullname;   ?></span></td>

                                            <td><?php echo $get_users_mobile;   ?></td>

                                            <td><?php echo $get_users_loginid;   ?></td>

                                            <td><?php echo $get_users_priority;   ?></td>

                                            <td> <?php echo $get_users_status;   ?></td>

                                          <!-- Action Buttons -->
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-top">
                                                        <a id="btnedit" class="dropdown-item edit-user-button" href="javascript:void(0)" data-id="<?php echo $get_users_Id; ?>"><i class="mdi mdi-pencil mr-1 text-primary font-18 vertical-middle" ></i>Edit User </a>
                                                        <a class="dropdown-item delete-user-button" href="javascript:void(0)" data-id="<?php echo $get_users_Id; ?>"><i class="mdi mdi-delete mr-1 text-danger font-18 vertical-middle"></i>Delete User</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>


                                    <?php 
                                 }
                               ?>
                                      