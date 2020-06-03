<?php
    include "../includes/header.php"
?>
    <?php
        try{
            // DBアクセス
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL実行(prepared statement なので安全)
            $sql =  'SELECT
                        code
                        , name
                    FROM
                        mst_category
                    ';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            // DB切断
            $dbh = null;

            print 'Category List';
            print '<br>';

            print '<form action="category_branch.php" method="post">';
            
            while(true){
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if($rec == false){
                    break;
                }
                print '<input type="radio" name="category_code" value="'.$rec['code'].'">';
                print $rec['name'];
                print '<br>';
            }

            print '<input type="submit" name="disp" value="Detail">';
            print '<input type="submit" name="add" value="Add">';
            print '<input type="submit" name="edit" value="Update">';
            print '<input type="submit" name="delete" value="Delete">';
            print '</form>';
        }
        catch(Exception $e){
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>
    <div>
        <a href="../staff_login/staff_top.php">トップメニューへ</a>
    </div>
</body>
</html>