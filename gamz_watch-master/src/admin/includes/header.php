<?php
    include '../session/session_check.php';
    include '../../common/Function.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gamz Watch Admin</title>

    <!-- Bootstrap Core CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
      integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
      crossorigin="anonymous"
    />
    <!-- <link href="../css/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
    <div class="col-sm-12">
        <header>
            <h1>
                <a href="../staff_login/staff_top.php">ADMIN HEADER</a>
            </h1>
            <?php
                if(!isset($_SESSION[SESSION_CON::$ADMIN_LOGIN])){
                    print 'login first.<br>';
                    print '<a href="../staff_login/staff_login.php">To login</a>';
                    exit();
                }else{
                    $staff = unserialize($_SESSION[SESSION_CON::$STAFF_ENTITY]);
                    print $staff->name;
                    print ' is login.';
                }
            ?>
        </header>
    </div>