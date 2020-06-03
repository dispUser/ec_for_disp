<?php
    include("header.php");
?>
<article id="shop_form">
    <div class="content_width">
        <h2>Customer Infomation</h2>
        <form action="shop_form_check.php" method="post">
            <div>Your name</div>
            <div>
                <input type="text" name="onamae">
            </div>    
            <div>Email</div>
            <div>
                <input type="text" name="email">
            </div>    
            <div>Postal number</div>
            <div>
                <input type="text" name="postal1">
                -
                <input type="text" name="postal2">
            </div>    
            <div>Address</div>
            <div>
                <input type="text" name="address">
            </div>    
            <div>Phone number</div>
            <div>
                <input type="text" name="tel">
            </div>
            <div>
                <div>
                    Password
                </div>
                <input type="password" name="pass">
                <div>
                    Re-enter password
                </div>
                <div>
                    <input type="password" name="pass2">
                </div>
            </div>
            <div>
                <input type="submit" value="OK" class="back_button button_fix">
                <input type="button" onclick="history.back()" value="Back" class="back_button button_fix">
            </div>
        </form>
    </div>
</article>
<?php
    include("footer.php");
    ?>