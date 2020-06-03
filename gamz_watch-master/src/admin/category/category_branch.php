<?php
    include '../session/session_check.php';
    
    if(isset($_POST['disp'])){
        if(!isset($_POST['category_code'])){
            header('Location: category_ng.php');
            exit();
        }
        $category_code = $_POST['category_code'];
        header('Location: category_disp.php?category_code='.$category_code);
        exit();
    }

    if(isset($_POST['add'])){
        header('Location: category_add.php');
        exit();
    }

    if(isset($_POST['edit'])){
        if(!isset($_POST['category_code'])){
            header('Location: category_ng.php');
            exit();
        }
        $category_code = $_POST['category_code'];
        header('Location: category_edit.php?category_code='.$category_code);
        exit();
    }

    if(isset($_POST['delete'])){
        if(!isset($_POST['category_code'])){
            header('Location: category_ng.php');
            exit();
        }
        $category_code = $_POST['category_code'];
        header('Location: category_delete.php?category_code='.$category_code);
        exit();
    }
?>