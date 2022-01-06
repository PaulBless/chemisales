<?php

setcookie("role",'', time() + (86400 * 30), '/');
setcookie("fullname", '', time() + (86400 * 30), '/');
setcookie("username",'', time() + (86400 * 30), '/');
setcookie("id",'', time() + (86400 * 30), '/');
setcookie("c_r",'', time() + (86400 * 30), '/');

session_unset();

echo "<script>window.location.href='index.php'</script>";

?>