<?php
    include "../includes/header.php";
?>
    <?php
        $order_code = $_POST['code'];
        $order_name = $_POST['name'];
        $order_price = $_POST['price'];
        $orderfit_rate = $_POST['orderfit_rate'];
        $shipment_fee = $_POST['shipment_fee'];
        $sale_price = $_POST['sale_price'];
        $order_gazou_name_old = $_POST['gazou_name_old'];
        $order_gazou = $_FILES['gazou'];
        $image_code = $_POST['image_code'];

        // 安全対策
        $order_code = htmlspecialchars($order_code, ENT_QUOTES, 'UTF-8');
        $order_name = htmlspecialchars($order_name, ENT_QUOTES, 'UTF-8');
        $order_price = htmlspecialchars($order_price, ENT_QUOTES, 'UTF-8');

        $hasError = false;

        if($order_name == ''){
            $hasError = true;
            $order_name = 'Item name is empty.';
        }

        if(preg_match('/\A[0-9]+\z/', $order_price) == 0){
            $hasError = true;
            $order_price = 'Item price is not collect.';
        }
        
        if(preg_match('/\A[0-9]+\z/', $orderfit_rate) == 0){
            $hasError = true;
            $orderfit_rate = 'orderfit rate is not collect.';
        }
        
        if(preg_match('/\A[0-9]+\z/', $shipment_fee) == 0){
            $hasError = true;
            $shipment_fee = 'Shipment fee is not collect.';
        }

        if(preg_match('/\A[0-9]+\z/', $sale_price) == 0){
            $hasError = true;
            $sale_price = 'Sale price is not collect.';
        }
        
        echo $order_gazou['size'];

        if($order_gazou['size'] > 0){
            if($order_gazou['size'] > 1000000){
                $hasError = true;
                $disp_gazou = 'Item size is too big';
            }else{
                // 
                move_uploaded_file($order_gazou['tmp_name'], './gazou/'.$order_gazou['name']);
                $disp_gazou = $order_gazou['name'];
            }
        }else{
            $disp_gazou = $order_gazou_name_old;
        }

    ?>
    <?php if($hasError){?>
        <div class="col-sm-12">
            <input type="button" onclick="history.back" value="Go back" class="btn">
        </div>
    <?php }else {?>
        <div class="col-sm-12">
            <h2>orderduction Fix</h2>
            <h3>Code</h3>
            <?php echo $order_code; ?>
            <h3>Name</h3>
            <?php echo $order_name; ?>
            <h3>Price</h3>
            <?php echo $order_price; ?>
            <h3>orderfit rate</h3>
            <?php echo $orderfit_rate; ?>
            <h3>Shipment fee</h3>
            <?php echo $shipment_fee; ?>
            <h3>Selling price</h3>
            <?php echo $sale_price; ?>
            <h3>Image</h3>
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <img class="img-thumbnail" src="gazou/<?php echo $disp_gazou; ?>" alt="test">
                </div>
            </div>
            <form action="order_edit_done.php" method="post">
                <input type="hidden" name="code" value="<?php echo $order_code ?>">
                <input type="hidden" name="name" value="<?php echo $order_name ?>">
                <input type="hidden" name="price" value="<?php echo $order_price ?>">
                <!-- FIXME:DELETE old name. name is not good enough key -->
                <input type="hidden" name="gazou_name_old" value="<?php echo $order_gazou_name_old ?>">
                <input type="hidden" name="image_code" value="<?php echo $image_code ?>">
                <input type="hidden" name="gazou_name" value="<?php echo $order_gazou['name'] ?>">
                <input type="hidden" name="gazou_size" value="<?php echo $order_gazou['size']; ?>">
                <input type="button" onclick="history.back()" value="戻る" class="btn">
                <input type="submit" value="OK" class="btn">
            </form>
        </div>
    <?php }?>

</body>
</html>