<?php
    include "../../common/Function.php";

    try{
        $member_email = $_POST['email'];
        $member_pass = $_POST['pass'];

        $member_email = htmlspecialchars($member_email, ENT_QUOTES, 'UTF-8');
        $member_pass = htmlspecialchars($member_pass, ENT_QUOTES, 'UTF-8');

        if($member_email == "" || $member_pass == ""){
            print '<div>Email or password is not collect.</div>';
            print '<a href="member_login.php">Go back</a>';            
        }else{
            $memberList = getMemberByEmailAndPass($member_email, $member_pass);
            if(count($memberList) == 0){
                print '<div>Email or password is not collect.</div>';
                print '<a href="member_login.php">Go back</a>';
            }else{
                session_start();
                $member = $memberList[0];
                $_SESSION[SESSION_CON::$FRONT_LOGIN] = 1;
                $_SESSION[SESSION_CON::$MEMBER_ENTITY] = serialize($member);
                header('Location:shop_list.php');
                exit();
            }
        }
    }
    catch(Exception $e){
        print 'DB ERROR';
        exit();
    }
?>

