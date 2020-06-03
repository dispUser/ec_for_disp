<?php
    include "../includes/header.php"
?>
    <?php
        try{
            $staff_code = $_GET['staffcode'];

            // DBアクセス
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL実行(prepared statement なので安全)
            $sql =  'SELECT name FROM mst_staff WHERE code = ?';
            $stmt = $dbh->prepare($sql);
            $data[] = $staff_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $staff_name = $rec['name'];

            // DB切断
            $dbh = null;
        }
        catch(Exception $e){
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>

    <h1>スタッフ削除</h1>
    <div>スタッフコード</div>
    <div>
        <?php print $staff_code; ?>
    </div>
    <div>スタッフ名</div>
    <div>
        <?php print $staff_name; ?>
    </div>
    <div>
        このスタッフを削除してもよろしいですか？
    </div>
    <form action="staff_delete_done.php" method="post">
        <input type="hidden" name="code" value="<?php print $staff_code ?>">
        <div>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </div>
    </form>
</body>
</html>