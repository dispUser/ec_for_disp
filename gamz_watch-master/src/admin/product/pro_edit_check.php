<?php
    include "../includes/header.php";
?>
<?php
    $pro_code = $_POST['code'];
    $pro_name = $_POST['name'];
    $pro_price = $_POST['price'];
    $profit_rate = $_POST['profit_rate'];
    $shipment_fee = $_POST['shipment_fee'];
    $sale_price = $_POST['sale_price'];
    $pro_gazou_name_old = $_POST['gazou_name_old'];
    $pro_gazou = $_FILES['gazou'];
    $image_code = $_POST['image_code'];

    // 安全対策
    $pro_code = htmlspecialchars($pro_code, ENT_QUOTES, 'UTF-8');
    $pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
    $pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

    $hasError = false;

    if($pro_name == ''){
        $hasError = true;
        $pro_name = 'Item name is empty.';
    }

    if(preg_match('/\A[0-9]+\z/', $pro_price) == 0){
        $hasError = true;
        $pro_price = 'Item price is not collect.';
    }
    
    if(preg_match('/\A[0-9]+\z/', $profit_rate) == 0){
        $hasError = true;
        $profit_rate = 'Profit rate is not collect.';
    }
    
    if(preg_match('/\A[0-9]+\z/', $shipment_fee) == 0){
        $hasError = true;
        $shipment_fee = 'Shipment fee is not collect.';
    }

    if(preg_match('/\A[0-9]+\z/', $sale_price) == 0){
        $hasError = true;
        $sale_price = 'Sale price is not collect.';
    }
    
    if($pro_gazou['size'] > 0){
        if($pro_gazou['size'] > 1000000){
            $hasError = true;
            $disp_gazou = 'Item size is too big';
            echo "Item size is too big.";
        }else{
            // file name from iphpne library is long
            // sample:
            // $pro_gazou['name'] = 6382A3C569-7168-4230-9518-4E2A3B8B2C7B.png
            $fileName = $pro_gazou['name'];
            // FIXME:
            // iPhoneから画像を登録した場合の名前がないので、20文字以上なら切り捨て
            // でどうでしょう
            // if($fileName > 20){}
            move_uploaded_file($pro_gazou['tmp_name'], './gazou/' . $fileName);
            $disp_gazou = $pro_gazou['name'];
        }
    }else{
        $disp_gazou = $pro_gazou_name_old;
    }

?>
<div class="col-sm-12">
    <?php if($hasError){?>
        <input type="button" onclick="history.back()" value="Go back">
    <?php }else {?>
        <h2>Production Fix</h2>
        <table class="table">
            <thead>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>Profit rate</th>
                <th>Shipment fee</th>
                <th>Selling price</th>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $pro_code; ?></td>
                    <td><?php echo $pro_name; ?></td>
                    <td><?php echo $pro_price; ?></td>
                    <td><?php echo $profit_rate; ?></td>
                    <td><?php echo $shipment_fee; ?></td>
                    <td><?php echo $sale_price; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="mb-2">
            <img class="w-25 rounded" src="gazou/<?php echo $disp_gazou; ?>" alt="test">
        </div>
        <form action="pro_edit_done.php" method="post">
            <input type="hidden" name="code" value="<?php echo $pro_code; ?>">
            <input type="hidden" name="name" value="<?php echo $pro_name; ?>">
            <input type="hidden" name="price" value="<?php echo $pro_price; ?>">
            <input type="hidden" name="profit_rate" value="<?php echo $profit_rate; ?>">
            <input type="hidden" name="shipment_fee" value="<?php echo $shipment_fee; ?>">
            <!-- FIXME:DELETE old name. name is not good enough key -->
            <input type="hidden" name="gazou_name_old" value="<?php echo $pro_gazou_name_old ?>">
            <input type="hidden" name="image_code" value="<?php echo $image_code ?>">
            <input type="hidden" name="gazou_name" value="<?php echo $pro_gazou['name'] ?>">
            <input type="hidden" name="gazou_size" value="<?php echo $pro_gazou['size']; ?>">
            <div class="mb-2">
                <input 
                    type="button" 
                    onclick="history.back()" 
                    value="Back" class="btn btn-secondary">
                <input type="submit" value="OK" class="btn btn-success">
            </div>
        </form>
    <?php }?>
</div>

</body>
</html>