<?php
    require_once("header.php");

    $member = unserialize($_SESSION[SESSION_CON::$MEMBER_ENTITY]);
    $code_member = $member->code;
    $order_code = $_GET['code'];
    $orderEntity = getOrderEntity($order_code);
    $itemEntityList = getItemEntityListInOrder($order_code);
?>

<article id="order_detail">
    <div class="content_width">
        
        <section>
            <h2>Order detail</h2>
            <div class="row">
                <div class="header">
                    <div class="td">
                        Order code
                    </div>
                    <div class="td">
                        Order date
                    </div>
                    <div class="td">
                        Subtotal
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="body">
                    <div class="td">
                        <?php print $orderEntity->code ?>
                    </div>
                    <div class="td">
                        <?php print $orderEntity->date ?>
                    </div>
                    <div class="td">
                        <span class="subtotal price"><?php print $orderEntity->order_price ?> pesos </span>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="row">
                <div class="status_header">
                    <div class="td">
                        Payment status
                    </div>
                    <div class="td">
                        Payment date
                    </div>
                    <div class="td">
                        Shipment status
                    </div>
                    <div class="td">
                        Shipment date
                    </div>
                    <div class="td">
                        Cancel status
                    </div>
                    <div class="td">
                        Cancel date
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="row">
                <div class="status_body">
                    <div class="td">
                        <?php print $orderEntity->payment_status ?>
                    </div>
                    <div class="td">
                        <?php print $orderEntity->payment_date ?>
                    </div>
                    <div class="td">
                        <?php print $orderEntity->shipment_status ?>
                    </div>
                    <div class="td">
                        <?php print $orderEntity->shipment_date ?>
                    </div>
                    <div class="td">
                        <?php print $orderEntity->cancel_status ?>
                    </div>
                    <div class="td">
                        <?php print $orderEntity->cancel_date ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </section>

        <section>
            <div>
                <?php if($orderEntity->cancel_status_code == Con::$status_uncanceled){ ?>
                    <?php if($orderEntity->payment_status_code == Con::$status_unpaid){ ?>
                        <a href="history_disp_payment.php?code=<?php print $orderEntity->code ?>" class="back_button fix_button main_button">Payment update</a>
                        <a href="history_disp_cancel.php?code=<?php print $orderEntity->code ?>" class="back_button fix_button">Cancel</a>
                    <?php } ?>
                <?php } ?>            
            </div>
        </section>
        
        <section>
            <h2>Order items</h2>
            <div class="item_list_box">
                <?php for($i = 0; $i < count($itemEntityList); $i++){ ?>
                <?php $orderItem = $itemEntityList[$i]; ?>
                    <div class="header">
                        <div class="td">
                            Image
                        </div>
                        <div class="td">
                            Product code
                        </div>
                        <div class="td">
                            Name
                        </div>
                        <div class="td">
                            Price
                        </div>
                        <div class="td">
                            Quantity
                        </div>
                        <div class="td last">
                            Total
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="tr">
                        <div class="td">
                            <div class="image_container">
                                <a href="shop_product.php?procode=<?php echo $orderItem->code_product; ?>&image_code=<?php echo $orderItem->image_code; ?>">
                                    <img src="../../admin/product/gazou/<?php print $orderItem->filename; ?>" alt="<?php print $orderItem->filename; ?>">
                                </a>
                            </div>
                        </div>
                        <div class="td">
                            <?php print $orderItem->code_product; ?>
                        </div>
                        <div class="td">
                            <?php print $orderItem->name; ?>
                        </div>
                        <div class="td">
                            <span class="price"><?php print $orderItem->price; ?> pesos</span>
                        </div>
                        <div class="td">
                            <?php print $orderItem->quantity; ?>
                        </div>
                        <div class="td last">
                            <span class="price"><?php print $orderItem->price * $orderItem->quantity; ?> pesos</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
            </div>
        </section>
        <section>
            <a href="history_list.php" class="back_button fix_button">To Order List</a>
        </section>
    </div>
</article>

<?php
    require_once("footer.php");
?>