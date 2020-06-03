<?php
    require_once("header.php");
    
    $order_code = $_GET['code'];
    // 安全化
    $order_code = htmlspecialchars($order_code, ENT_QUOTES, 'UTF-8');
    updateOrderPayment($order_code, CON::$status_paid);
    
?>

<article id="history_disp_payment_done">
    <div class="content_width">
        <h2>Order payment update done</h2>
        <div>
            Payment status updated.
        </div>
        <div>
            <a href="history_disp.php?code=<?php print $order_code ?>" class="back_button fix_button">Back</a>
        </div>
    </div>
</article>