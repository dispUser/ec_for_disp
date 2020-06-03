<?php
    include("header.php");

    if(isset($_SESSION[SESSION_CON::$CART_ENTITY])){
        $cart = unserialize($_SESSION[SESSION_CON::$CART_ENTITY]);
        
        $total_price = $cart->getTotalPrice();
        $count = $cart->getItemCount();
    }else{
        $cart = new Cart;
    }

    echo "<pre>";
    var_dump($cart);
    echo "</pre>";
?>

    <article id="cart">
        <div class="content_width">
            <?php if(count($cart->cartItemList) == 0){ ?>
                <div>
                    No item in cart.
                </div>
                <div>
                    <a href="shop_list.php" class="back_button fix_button">Go to top</a>
                </div>
                <?php exit(); ?>
            <?php } ?>
            <h2>Items in Cart</h2>
            <form action="kazu_change.php" method="post">
                <div class="subtotal">
                    Subtotal (<?php print $count ?> item): <span class="price total_price"><?php print $total_price; ?> Pesos</span>
                </div>
                <div class="item_list_box">
                    <?php for($i = 0; $i < count($cart->cartItemList); $i++){ ?>
                        <?php $cartItem = $cart->cartItemList[$i]; ?>
                        <div class="item_box">
                            <div class="image_box">
                                <img src="../../admin/product/gazou/<?php echo $cartItem->file_name; ?>">
                            </div>
                            <div class="name_box">
                                <?php print $cartItem->name; ?>
                            </div>
                            <div class="detail_box">
                                <div class="float_box">
                                    <span class="price"><?php print getSalePrice($cartItem); ?> Pesos</span>
                                </div>
                                <div  class="float_box">
                                    <input 
                                        type="number"
                                        name="kazu<?php print $i; ?>"
                                        value="<?php print $cartItem->quantity; ?>">
                                </div>
                                <div class="float_box">
                                    <span class="price total_price"><?php print (getSalePrice($cartItem) * $cartItem->quantity); ?> Pesos</span>
                                </div>
                                <div class="float_box delete_box">
                                    <div>
                                        <a href="kazu_change.php?delete=<?php print $i ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="line"></div>
                        </div>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
                <div>
                    <input type="hidden" name="max" value="<?php print count($cart->cartItemList); ?>">
                </div>
                <div>
                    <input type="submit" name="calc" value="calculate" class="back_button cart_button">
                </div>
                <?php if(isset($_SESSION[SESSION_CON::$FRONT_LOGIN]) == false){?>
                    <div>
                        <a href="shop_form.php" class="back_button checkout_button">Proceed to checkout</a>
                    </div>
                <?php } ?>
                <div>
                    <?php
                        if(isset($_SESSION[SESSION_CON::$FRONT_LOGIN])==true){
                            print '<a href="shop_kantan_check.php" class="checkout_button back_button">Easy purchase</a>';
                        }
                    ?>
                </div>
                <div>
                    <input type="button" onclick="history.back()" value="back" class="back_button cart_button">
                </div>
            </form>
        </div>
    </article>

<?php
    require_once("footer.php");
?>