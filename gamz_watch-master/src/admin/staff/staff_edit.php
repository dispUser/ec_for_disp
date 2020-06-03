<?php
    include "../includes/header.php";

    try{
        $staff_code = $_GET['staffcode'];

        // DBアクセス
        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
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

    <div class="col-sm-12">
        <h2>Staff edit</h2>
        <div>Staff code</div>
        <div>
            <?php print $staff_code; ?>
        </div>
        <form action="staff_edit_check.php" method="post">
            <input type="hidden" name="code" value="<?php print $staff_code; ?>">
            <div class="form-group">
                <label>Staff Name</label>
                <input class="form-control" type="text" name="name" value="<?php print $staff_name ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="pass">
            </div>
            <div class="form-group">
                <label>Re Password</label>
                <input class="form-control" type="password" name="pass2">
            </div>
            <div>
                <input class="btn btn-secondary" type="button" onclick="history.back()" value="Back">
                <input class="btn btn-success" type="submit" value="OK">
            </div>
        </form>
    </div>
</body>
</html>