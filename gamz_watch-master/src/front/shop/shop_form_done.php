    <?php
        require_once("header.php");
        
        // cart check
        $cart = unserialize($_SESSION[SESSION_CON::$CART_ENTITY]);
        if(count($cart->cartItemList) == 0){
            header("Location:shop_list.php");
            exit();
        }

        $post = sanitize($_POST);

        // get member
        $member = new Member;
        $member->name = $post['onamae'];
        $member->email = $post['email'];
        $member->postal1 = $post['postal1'];
        $member->postal2 = $post['postal2'];
        $member->address = $post['address'];
        $member->tel = $post['tel'];
        $member->password = $post['pass'];

        // regist order
        $last_order_code = execGuestOrder($member, $cart);

        // clear cart
        $cart = new Cart;
        $_SESSION[SESSION_CON::$CART_ENTITY] = serialize($cart);

        // auto login
        $_SESSION[SESSION_CON::$FRONT_LOGIN] = 1;
        $_SESSION[SESSION_CON::$MEMBER_ENTITY] = serialize($member);

    ?>

    <article id="shop_form_done">
        <div class="content_width">
            <h2>Order Complete</h2>
            <div>
                <a href="history_disp.php?code=<?php print $last_order_code ?>" class="back_button fix_button">Go to order detail</a>
            </div>
            <a href="shop_list.php" class="back_button fix_button">Go to top.</a>
        </div>
    </article>
</body>
</html>