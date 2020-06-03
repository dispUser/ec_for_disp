<?php
    include '../session/session_check.php';
    
    if(isset($_POST['disp'])){
        if(!isset($_POST['index'])){
            header('Location: pro_ng.php');
            exit();
        }
        $index = $_POST['index'];
        header('Location: pro_disp.php?index='.$index);
        exit();
    }

    if(isset($_POST['add_item'])){
        header('Location: pro_add.php');
        exit();
    }

    if(isset($_POST['add_image'])){
        header('Location: pro_add.php');
        exit();
    }
    
    if(isset($_POST['edit'])){
        if(!isset($_POST['index'])){
            header('Location: pro_ng.php');
            exit();
        }
        $index = $_POST['index'];
        header('Location: pro_edit.php?index='.$index);
        exit();
    }
?>