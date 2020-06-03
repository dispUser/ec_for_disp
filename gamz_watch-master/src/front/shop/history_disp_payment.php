<?php
    require_once("header.php");

    $order_code = $_GET['code']
?>

<article id="history_disp_payment">
    <div class="content_width">
        <h2>Order payment update</h2>
        <div>
            Paid already?
        </div>
        <h3 class="warning">
            No cancel after you update.
        </h3>
        <div>
            <form action="history_disp_payment_done.php" method="get">
                <div>
                    <input type="submit" value="Yes" class="back_button main_button fix_button">
                </div>
                <div>
                    <input type="button" onclick="history.back()" value="Back" class="back_button fix_button">
                </div>
                <input type="hidden" name="code" value="<?php print $order_code ?>">
            </form>
        </div>
    </div>
</article>