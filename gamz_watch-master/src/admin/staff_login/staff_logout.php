<?php
    session_start();
    //セッション変数(秘密文書)を空にする
    $_SESSION = array();
    if(isset($_COOKIE[session_name()])){
        //PCのセッションID(合言葉)をクッキーから削除する
        setcookie(session_name(),'',time()-42000,'/');
    }
    //セッションを破棄する
    session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gamz Watch Online</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="col-sm-12">
        <h2>Log out</h2>
        <div>
            <a href="../staff_login/staff_login.php">To login</a>
        </div>
    </div>
</body>
</html>