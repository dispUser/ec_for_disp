<?php
    require_once("header.php");

    $order_code = $_GET['code']
?>

<article id="history_disp_cancel">
    <div class="content_width">
        <h2>Order cancel</h2>
        <div>
            Are you sure you need cancel?
        </div>
        <div>
            <form action="history_disp_cancel_done.php" method="get">
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