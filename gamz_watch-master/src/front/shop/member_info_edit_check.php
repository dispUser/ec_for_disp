<?php
    require_once("header.php");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $postal1 = $_POST['postal1'];
    $postal2 = $_POST['postal2'];
    $address = $_POST['address'];
?>

<article id="member_info_check">
    <div class="content_width">
        <h2>Check member infomation</h2>
        <div class="name box">
            <h3>Name</h3>
            <div>
                <?php print $name; ?>
            </div>
        </div>
        <div class="email box">
            <h3>Email</h3>
            <div>
                <?php print $email; ?>
            </div>
        </div>
        <div class="postal box">
            <h3>Postal</h3>
            <div>
                <?php print $postal1 ?>
                -
                <?php print $postal2; ?>
            </div>
        </div>
        <div class="address box">
            <h3>Address</h3>
            <div>
                <?php print $address; ?>
            </div>
        </div>
        <form action="member_info_edit_done.php" method="post">
            <input type="hidden" value="<?php print $name ?>" name="name">
            <input type="hidden" value="<?php print $email ?>" name="email">
            <input type="hidden" value="<?php print $postal1 ?>" name="postal1">
            <input type="hidden" value="<?php print $postal2 ?>" name="postal2">
            <input type="hidden" value="<?php print $address ?>" name="address">
            <div class="box">
                <input type="submit" class="back_button fix_button regist_button" value="Regist infomation">
            </div>
        </form>
        <div class="box">
            <input type="button" onclick="history.back()" value="back" class="back_button fix_button">
        </div>
    </div>
</article>

<?php
    require_once("footer.php");
?>