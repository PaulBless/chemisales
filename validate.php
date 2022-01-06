<?php
session_start();
error_reporting(1);
// require_once 'db/db.php';
require_once 'session.php';

if(isset($_SESSION['user'])){
    $selected_userid = $_SESSION['user']; // get user session value
    
    $login_user_role = $user_details['user_type'];

    if($login_user_role === '1'){    // access type is admin
        // redirect to admin menu
        setcookie("c_r", 'a', time() + (86400 * 30), '/');
        // setcookie("c_r", $login_user_role, time() + (86400 * 30), '/');
        echo "<script>window.location.href='admin.dashboard.php'</script>"; 

    }elseif ($login_user_role === '2'){     // access type is manager
            // redirect to manager menu
            setcookie("c_r", 'm', time() + (86400 * 30), '/');
            // setcookie("c_r", $login_user_role, time() + (86400 * 30), '/');
            echo "<script>window.location.href='manager.menu.php'</script>"; 

        }elseif($login_user_role === '3'){      // access type is attendant or pharmacist
            // setcookie("c_r", $login_user_role, time() + (86400 * 30), '/');
            setcookie("c_r", 'p', time() + (86400 * 30), '/');
            echo "<script>window.location.href='billing.php'</script>";
        }
        else{
        echo "<script>window.location.href='index.php'</script>";
    }

    
}

?>