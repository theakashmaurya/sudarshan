<?php

session_start();
ob_start();

unset($_SESSION['userid']);
unset($_SESSION['fullname']);
unset($_SESSION['actype']);
unset($_SESSION['active']);

session_destroy();

header('location:../index.php?msgtype=text-info&msg=Logged out successfully!')

?>