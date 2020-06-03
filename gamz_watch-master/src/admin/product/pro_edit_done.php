<?php
    include "../includes/header.php";
?>
    <?php
        try{
            $item = new Item;
            $item->code = $_POST['code'];
            $item->name = $_POST['name'];
            $item->price = $_POST['price'];
            $item->profit_rate = $_POST['profit_rate'];
            $item->shipment_fee = $_POST['shipment_fee'];

            // image
            $item->image_code = $_POST['image_code'];
            $item->file_name = $_POST['gazou_name'];
            $item->file_name_old = $_POST['gazou_name_old'];
            $item->file_size = $_POST['gazou_size'];

            // 安全化
            $item->code = htmlspecialchars($item->code, ENT_QUOTES, 'UTF-8');
            $item->name = htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8');
            $item->price = htmlspecialchars($item->price, ENT_QUOTES, 'UTF-8');

            // 商品をUPDATE
            execUpdateItem($item);

            // 画像がアップロードされている場合のみ更新する
            if($item->file_size > 0){

                // 商品画像をUPDATE
                execUpdateImage($item);

                // [商品コード + ファイル名]にリネーム
                rename("./gazou/" . $item->file_name, "./gazou/" . $item->code . $item->file_name);
                
                // 古い画像が存在する場合はDELETE
                if(file_exists('./gazou/'.$item->file_name_old)){
                    unlink('./gazou/'.$item->file_name_old);
                }
            }

            // DB切断
            $dbh = null;

        }
        catch(Exception $e){
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }
    ?>
    <div class="col-sm-12">
        <h2>Fix Done</h2>
        <div class="col-sm-12">
            <a href="pro_list.php">Go back</a>
        </div>
    </div>

</body>
</html>