<?php
    include "../includes/header.php";
    $order_code = $_POST['order_code'];

    updateOrderShipment($order_code, Con::$status_shipped);
?>

<div class="col-sm-12">
    <h2>Shipment Update Done</h2>
    <p>Order updated.</p>
    <a href="order_disp.php?ordercode=<?php echo $order_code; ?>">To order</a>
</div>

</body>
</html>