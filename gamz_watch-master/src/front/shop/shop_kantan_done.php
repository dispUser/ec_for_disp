<?php
    include "header.php";

    // cart check
    $cart = unserialize($_SESSION[SESSION_CON::$CART_ENTITY]);
    $cart_count = count($cart->cartItemList);
    if($cart_count == 0){
        header("Location:shop_list.php");
        exit();
    }

    // regist order
    $last_order_code = execMemberOrder($cart); 
    
    // clear cart
    $cart = new Cart;
    $_SESSION[SESSION_CON::$CART_ENTITY] = serialize($cart);
    
?>

    <article id="shop_kantan_done">
        <div class="content_width">
            <h2>Order complete</h2>
            <p>Thank you for order.</p>
            <div>
                <a href="history_disp.php?code=<?php print $last_order_code ?>" class="back_button fix_button">Go to order detail</a>
            </div>
            <div>
                <a href="shop_list.php" class="back_button fix_button">Go to top</a>
            </div>
        </div>
    </article>
</body>
</html>