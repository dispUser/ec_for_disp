<?php
    include "../includes/header.php"
?>
    <div>ダウンロードしたい注文日を選んでください。</div>
    <form action="order_download_done.php" method="post">
        
        <?php
            pulldown_year();
            pulldown_month();
            pulldown_day();
        ?>
        <div>
            <input type="submit" value="ダウンロードへ">
        </div>
    </form>
</body>
</html>