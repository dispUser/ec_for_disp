<?php
    require_once("header.php");
    
    $order_code = $_GET['code'];
    updateOrderCancel($order_code, CON::$status_canceled);

?>

<article id="history_disp_payment_done">
    <div class="content_width">
        <h2>Order cancel update done</h2>
        <div>
            Cancel status updated.
        </div>
        <div>
            <a href="history_disp.php?code=<?php print $order_code ?>" class="back_button fix_button">Back</a>
        </div>
    </div>
</article>