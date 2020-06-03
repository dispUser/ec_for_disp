<?php
    include "../includes/header.php"
?>
    <?php
        try{
            $staff_code = $_POST['code'];

            // DBアクセス
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL実行(prepared statement なので安全)
            $sql =  'DELETE FROM mst_staff WHERE code = ?';
            $stmt = $dbh->prepare($sql);
            $data[] = $staff_code;
            $stmt->execute($data);

            // DB切断
            $dbh = null;

        }
        catch(Exception $e){
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>
    <div>削除しました。</div>
    <a href="staff_list.php">戻る</a>
</body>
</html>