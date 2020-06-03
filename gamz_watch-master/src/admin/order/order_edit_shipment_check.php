<?php
    include "../includes/header.php";
    $order_code = $_GET['ordercode'];
?>

<div class="col-sm-12">
    <h2>Shipment Update Check</h2>
    <p>Already Shipped?</p>
    <form action="order_edit_shipment_done.php" method="post">
        <input type="submit" value="yes" class="btn">
        <input type="button" onclick="history.back()" value="Go back" class="btn">
        <input type="hidden" value="<?php echo $order_code; ?>" name="order_code">
    </form>
</div>

</body>
</html>