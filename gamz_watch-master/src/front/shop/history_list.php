<?php
    require_once("header.php");
    $member = unserialize($_SESSION[SESSION_CON::$MEMBER_ENTITY]);
    $orderList = getAllOrderListInMember($member->code);
?>

<article id="history_list">
    <div class="content_width">
        <h2>Purchase history</h2>
        <div class="header">
            <div class="td">Order code</div>
            <div class="td">Date</div>
            <div class="td">Subtotal</div>
            <div class="td">Payment</div>
            <div class="td">Shipment</div>
            <div class="td last">Cancel</div>
            <div class="clear"></div>
        </div>
        <?php for($i = 0; $i < count($orderList); $i++){ ?>
            <?php $order = $orderList[$i]; ?>
                <div class="order_box tr">
                    <a href="history_disp.php?code=<?php print $order->code; ?>">
                        <div class="td">
                            <?php print $order->code; ?>
                        </div>
                        <div class="td">
                            <?php print $order->date; ?>
                        </div>
                        <div class="td">
                           <span class="subtotal"><?php print $order->order_price; ?> pesos</span>
                        </div>
                        <div class="td">
                            <?php print $order->payment_status ?>
                        </div>
                        <div class="td">
                            <?php print $order->shipment_status ?>
                        </div>
                        <div class="td last">
                            <?php print $order->cancel_status ?>
                        </div>
                    </a>
                    <div class="clear"></div>
                </div>
        <?php } ?>
    </div>
</article>

<?php
    require_once("footer.php");
?>