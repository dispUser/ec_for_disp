<?php
    include "../includes/header.php";
?>
    <?php
        $item = unserialize($_SESSION[SESSION_CON::$ITEM_ENTITY]);

        // 商品を追加
        // 商品画像を追加
        // ランキングを追加
        $item = execAddItem($item);

        // 登録成功時のみコードが設定される
        if(isset($item->code)){
            // 画像を[商品番号 + ループindex + 画像名]でリネーム
            // 別商品であっても、同じ画像名をアップすると、
            // 画像を上書きしてしまうため、商品コードを追加して、一意にする
            for($i = 0; $i < count($item->imageEntityList); $i++){
                rename("./gazou/" . $item->imageEntityList[$i]->file_name
                        , "./gazou/" . $item->code . $i. $item->imageEntityList[$i]->file_name);
            }

            print $item->name;
            print ' is added';
        }else{
            print 'add item failed';
        }

    ?>

    <a href="pro_list.php">Back</a>
</body>
</html>