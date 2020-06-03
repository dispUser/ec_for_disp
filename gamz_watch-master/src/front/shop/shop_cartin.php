<?php
    include("header.php");

    try{
        $pro_code = $_GET['procode'];
        $image_code = $_GET['image_code'];

        // setup cart
        if(isset($_SESSION[SESSION_CON::$CART_ENTITY])){
            $cart = unserialize($_SESSION[SESSION_CON::$CART_ENTITY]);
        }else{
            $cart = new Cart();
        }

        $itemList = getItemByCode($pro_code, $image_code);

        if($itemList == 0){
            echo 'no item';
            exit();
        }else{
            $item = $itemList[0];
        }

        $item_exist_flag = $cart->addItemToCart($item);
        $_SESSION[SESSION_CON::$CART_ENTITY] = serialize($cart);
    }
    catch(Exception $e){
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
    }

?>
    <article id="cartin">
        <?php if($item_exist_flag){?>
            <h3>The item already exists in cart.</h3>
            <div>
                <a href="shop_list.php" class="back_button fix_button">Go to top</a>
            </div>
        <?php }else{ ?>
            <h3>Added to Cart.</h3>
            <div>
                <a href="shop_cartlook.php" class="back_button fix_button"><i class="far fa-play-circle"></i> Buy now</a>
            </div>
            <div>
                <a href="shop_list.php" class="back_button fix_button">Go to top</a>
            </div>
        <?php } ?>
    </article>
</body>
</html>