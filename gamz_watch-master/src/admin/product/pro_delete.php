<?php
    include "../includes/header.php"
?>
    <?php
        try{
            $pro_code = $_GET['procode'];

            // DBアクセス
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL実行(prepared statement なので安全)
            //$sql =  'SELECT code, name, price, gazou FROM mst_product WHERE code = ?';
            $sql = "SELECT 
                        mst_product.code as code
                        , mst_product.name as name
                        , mst_product.price as price
                        , mst_image.file_name as gazou
                        , rel_product_image.code as rel_code
                        , mst_image.code as image_code
                    FROM
                        mst_product
                    LEFT OUTER JOIN
                        rel_product_image
                    ON
                        mst_product.code = rel_product_image.product_code
                    LEFT OUTER JOIN
                        mst_image
                    ON
                        mst_image.code = rel_product_image.image_code
                    WHERE
                        mst_product.code = ?
                    ;";
            $stmt = $dbh->prepare($sql);
            $data[] = $pro_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $pro_code = $rec['code'];
            $pro_name = $rec['name'];
            $pro_price = $rec['price'];
            $pro_gazou = $rec['gazou'];
            $rel_code = $rec['rel_code'];
            $image_code = $rec['image_code'];

            // DB切断
            $dbh = null;

            if($pro_gazou == ''){
                $disp_gazou = '';
            }else{
                $disp_gazou = '<img src="./gazou/'.$pro_gazou.'">';
            }
        }
        catch(Exception $e){
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>

    <h1>商品削除</h1>
    <div>商品コード</div>
    <div>
        <?php print $pro_code; ?>
    </div>
    <div>商品名</div>
    <div>
        <?php print $pro_name; ?>
    </div>
    <div>価格</div>
    <div>
        <?php print $pro_price; ?>
    </div>
    <div>
        この商品を削除してもよろしいですか？
    </div>
    <form action="pro_delete_done.php" method="post">
        <input type="hidden" name="code" value="<?php print $pro_code ?>">
        <input type="hidden" name="name" value="<?php print $pro_name ?>">
        <input type="hidden" name="price" value="<?php print $pro_price ?>">
        <input type="hidden" name="rel_code" value="<?php print $rel_code ?>">
        <input type="hidden" name="image_code" value="<?php print $image_code ?>">
        <div>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </div>
    </form>
</body>
</html>