<?php
    include "../includes/header.php"
?>
<body>
    <?php
        try{
            $category_name = $_POST['name'];

            // 安全化
            $category_name = htmlspecialchars($category_name, ENT_QUOTES, 'UTF-8');

            // DBアクセス
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL実行(prepared statement なので安全)
            $sql =  'INSERT INTO mst_category(name) VALUES(?)';
            $stmt = $dbh->prepare($sql);
            $data[] = $category_name;
            $stmt->execute($data);

            // DB切断
            $dbh = null;

            print 'Added ';
            print $category_name;
        }
        catch(Exception $e){
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>

    <a href="category_list.php">To top</a>
</body>
</html>