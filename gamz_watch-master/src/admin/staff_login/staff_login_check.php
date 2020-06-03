<?php
    include "../../common/Function.php";

    $staff_code = $_POST['code'];
    $staff_pass = $_POST['pass'];

    $staffList = getStaffByCodeAndPass($staff_code, $staff_pass);
    // $staffList = array();
    // $staffList[] = 1;

    if(count($staffList) == 0){
        print '<div>Staff code or password is wrong.</div>';
        print '<a href="staff_login.php">Go back</a>';
    }else{
        $staff = $staffList[0];
        session_start();
        $_SESSION[SESSION_CON::$ADMIN_LOGIN] = 1;
        $_SESSION[SESSION_CON::$STAFF_ENTITY] = serialize($staff);
        header('Location:staff_top.php');
        exit();
    }
?>

