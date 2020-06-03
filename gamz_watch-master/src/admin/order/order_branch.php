<?php
    include '../session/session_check.php';
    
    if(isset($_POST['disp'])){
        if(!isset($_POST['ordercode'])){
            header('Location: pro_ng.php');
            exit();
        }
        $pro_code = $_POST['ordercode'];
        header('Location: order_disp.php?ordercode='.$pro_code);
        exit();
    }

    if(isset($_POST['add'])){
        header('Location: pro_add.php');
        exit();
    }

    if(isset($_POST['edit'])){
        if(!isset($_POST['ordercode'])){
            header('Location: pro_ng.php');
            exit();
        }
        $pro_code = $_POST['ordercode'];
        header('Location: order_edit.php?ordercode='.$pro_code);
        exit();
    }

    if(isset($_POST['delete'])){
        if(!isset($_POST['ordercode'])){
            header('Location: pro_ng.php');
            exit();
        }
        $pro_code = $_POST['ordercode'];
        header('Location: pro_delete.php?ordercode='.$pro_code);
        exit();
    }
?>