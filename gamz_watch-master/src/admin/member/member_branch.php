<?php
    include '../session/session_check.php';
    
    if(isset($_POST['disp'])){
        if(!isset($_POST['member_code'])){
            header('Location: member_ng.php');
            exit();
        }
        $member_code = $_POST['member_code'];
        header('Location: member_disp.php?member_code='.$member_code);
        exit();
    }

    if(isset($_POST['add'])){
        header('Location: member_add.php');
        exit();
    }

    if(isset($_POST['edit'])){
        if(!isset($_POST['member_code'])){
            header('Location: member_ng.php');
            exit();
        }
        $member_code = $_POST['member_code'];
        header('Location: member_edit.php?member_code='.$member_code);
        exit();
    }

    if(isset($_POST['delete'])){
        if(!isset($_POST['member_code'])){
            header('Location: member_ng.php');
            exit();
        }
        $member_code = $_POST['member_code'];
        header('Location: member_delete.php?member_code='.$member_code);
        exit();
    }
?>