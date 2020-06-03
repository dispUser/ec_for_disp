<?php
    require_once("header.php");
    //セッション変数(秘密文書)を空にする
    $_SESSION = array();
    if(isset($_COOKIE[session_name()])){
        //PCのセッションID(合言葉)をクッキーから削除する
        setcookie(session_name(),'',time()-42000,'/');
    }
    //セッションを破棄する
    session_destroy();
?>
    <article id="logout">
        <div class="content_width">
            <div>
                You logout.
            </div>
            <div>
                <a href="shop_list.php" class="back_button fix_button">Go to item list.</a>    
            </div>
        </div>
    </article>