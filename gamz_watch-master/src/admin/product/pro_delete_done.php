<?php
    include "../includes/header.php"
?>
    <?php
        try{
            $pro_code = $_POST['code'];
            $rel_code = $_POST['rel_code'];
            $image_code = $_POST['image_code'];

            // DBアクセス
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL実行(prepared statement なので安全)
            $sql =  'DELETE FROM mst_product WHERE code = ?';
            $stmt = $dbh->prepare($sql);
            $data[] = $pro_code;
            $stmt->execute($data);
            
            $sql =  'DELETE FROM rel_product_image WHERE code = ?';
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $rel_code;
            $stmt->execute($data);
            
            $sql =  'DELETE FROM mst_image WHERE code = ?';
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $image_code;
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
    <a href="pro_list.php">戻る</a>
</body>
</html>