<?php
    include '../session/session_check.php';

    if(isset($_POST['disp'])){
        if(!isset($_POST['staffcode'])){
            header('Location: staff_ng.php');
            exit();
        }
        $staff_code = $_POST['staffcode'];
        header('Location: staff_disp.php?staffcode='.$staff_code);
        exit();
    }

    if(isset($_POST['add'])){
        header('Location: staff_add.php');
        exit();
    }

    if(isset($_POST['edit'])){
        if(!isset($_POST['staffcode'])){
            header('Location: staff_ng.php');
            exit();
        }
        $staff_code = $_POST['staffcode'];
        header('Location: staff_edit.php?staffcode='.$staff_code);
        exit();
    }

    if(isset($_POST['delete'])){
        if(!isset($_POST['staffcode'])){
            header('Location: staff_ng.php');
            exit();
        }
        $staff_code = $_POST['staffcode'];
        header('Location: staff_delete.php?staffcode='.$staff_code);
        exit();
    }
?>