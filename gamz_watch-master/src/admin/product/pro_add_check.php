<?php
    include "../includes/header.php"
?>
    <?php
        $item_name = $_POST['name'];
        $pro_price = $_POST['price'];
        $profit_rate = $_POST['profit_rate'];
        $shipment_fee = $_POST['shipment_fee'];
        $sale_price = $_POST['sale_price'];
        $pro_gazou = $_FILES['upload_file'];

        // 安全対策
        $item_name = htmlspecialchars($item_name, ENT_QUOTES, 'UTF-8');
        $pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

        $item = new Item;
        $item->name = $item_name;
        $item->price = $pro_price;
        $item->profit_rate = $profit_rate;
        $item->shipment_fee = $shipment_fee;

        for($i = 0; $i < count($pro_gazou["name"]); $i++){
            $image = new Image;
            $image->file_name = $pro_gazou["name"][$i];
            array_push($item->imageEntityList, $image);
        }

        $hasError = false;

        if($item_name == ''){
            $hasError = true;
            print 'Item name is blank.';
            print '<br>';
        }else{
            print 'Item name:';
            print $item_name;
            print '<br>';
        }

        if(preg_match('/\A[0-9]+\z/', $pro_price) == 0){
            $hasError = true;
            print 'Item price is not collect.';
            print '<br>';
        }else{
            print 'Item Price:';
            print $pro_price;
            print '<br>';
        }
        
        if(preg_match('/\A[0-9]+\z/', $profit_rate) == 0){
            $hasError = true;
            print 'Profit rate is not collect.';
            print '<br>';
        }else{
            print 'Profit rate:';
            print $profit_rate;
            print '<br>';
        }
        
        if(preg_match('/\A[0-9]+\z/', $shipment_fee) == 0){
            $hasError = true;
            print 'Shipment fee is not collect.';
            print '<br>';
        }else{
            print 'Shipment fee:';
            print $shipment_fee;
            print '<br>';
        }
        
        if(preg_match('/\A[0-9]+\z/', $sale_price) == 0){
            $hasError = true;
            print 'Sale price is not collect.';
            print '<br>';
        }else{
            print 'Sale price:';
            print $sale_price;
            print '<br>';
        }



        if($_FILES["upload_file"]["name"][0] == ""){
            $hasError = true;
            print 'image is necessary.';
        }else{
            // ファイルがあれば処理実行
            if(isset($_FILES["upload_file"])){
    
                // アップロードされたファイル件を処理
                for($i = 0; $i < count($_FILES["upload_file"]["name"]); $i++ ){
    
                    // アップロードされたファイルか検査
                    if(is_uploaded_file($_FILES["upload_file"]["tmp_name"][$i])){
    
                        // ファイルをお好みの場所に移動
                        move_uploaded_file($_FILES["upload_file"]["tmp_name"][$i], "./gazou/" . $_FILES["upload_file"]["name"][$i]);
    
                        $file_name = $_FILES["upload_file"]["name"][$i];
    
                        // 画像を表示
                        print '<img src="./gazou/'.$file_name.'" alt="">';
                    }
                }
                print "<br>";
            }
        }


        if($hasError){
            print '<form>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '</form>';
        }else{
            $_SESSION[SESSION_CON::$ITEM_ENTITY] = serialize($item);
            print 'Item below will be added...<br>';
            print '<form action="pro_add_done.php" method="post">';
            // print '<input type="hidden" name="name" value="'.$item_name.'">';
            // print '<input type="hidden" name="price" value="'.$pro_price.'">';
            // print '<input type="hidden" name="profit_rate" value="'.$profit_rate.'">';
            // print '<input type="hidden" name="shipment_fee" value="'.$shipment_fee.'">';
            // print '<input type="hidden" name="sale_price" value="'.$sale_price.'">';
            // print '<input type="hidden" name="price" value="'.$pro_price.'">';
            // print '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
            print '<input type="button" onclick="history.back()" value="Go back">';
            print '<input type="submit" value="OK">';
            print '</form>';
        }


    ?>

</body>
</html>