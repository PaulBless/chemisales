<?php

require_once 'session.php';

## Grant Access Based On User Role/Type
if($users_role === '1'){
    // redirect to admin dashboard
    setcookie("c_r", 'a', time() + (86400 * 30), '/');
    // echo "<script>window.location.href='admin.dashboard.php'</script>"; 
    header('location: pos.php' );
    mysqli_close($connect_db);

}elseif($users_role === '2'){
    // redirect to manager dashboard
    setcookie("c_r", 'm', time() + (86400 * 30), '/');
    header ("location: manager.dashboard.php"); 
    mysqli_close($connect_db);
}elseif($users_role === '3'){
    setcookie("c_r", 'p', time() + (86400 * 30), '/');
    header('location: pos.billing.php');
    mysqli_close($connect_db);
}else{
    header('location: index.php');
    mysqli_close($connect_db);
}



?>