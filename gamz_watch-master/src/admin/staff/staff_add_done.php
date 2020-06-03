<?php
    include "../includes/header.php"
?>
    <?php
        try{
            $staff_name = $_POST['name'];
            $staff_pass = $_POST['pass'];

            // 安全化
            $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
            $staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');

            // DBアクセス
            $dbh = new PDO(CON::$dsn, CON::$user, CON::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL実行(prepared statement なので安全)
            $sql =  'INSERT INTO mst_staff(name, password) VALUES(?,?)';
            $stmt = $dbh->prepare($sql);
            $data[] = $staff_name;
            $data[] = $staff_pass;
            $stmt->execute($data);

            // DB切断
            $dbh = null;

        }
        catch(Exception $e){
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>

    <div class="col-xm-12">
        <h2>Staff Add Done</h2>
        <div>
            Added <?php echo $staff_name?>
        </div>
        <div class="form-group">
            <a href="staff_list.php" class="btn btn-secondary">Back</a>
        </div>
    </div>
</body>
</html>