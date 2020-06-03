<?php
    include("header.php");
    $member = unserialize($_SESSION[SESSION_CON::$MEMBER_ENTITY]);
?>
    <article id="kantan_check">
        <div class="content_width">
            <div class="box first">
                <div class="title">
                    Name
                </div>
                <div>
                    <?php print $member->name ?>
                </div>
            </div>
            <div class="box">
                <div class="title">
                    Email
                </div>
                <div>
                    <?php print $member->email ?>
                </div>
            </div>
            <div class="box">
                <div class="title">
                    Postal code
                </div>
                <div>
                    <?php print $member->postal1 . " - " . $member->postal2 ?>
                </div>
            </div>
            <div class="box">
                <div class="title">
                    Address
                </div>
                <div>
                    <?php print $member->address ?>
                </div>
            </div>
            <div class="box">
                <div class="title">
                    Tel
                </div>
                <div>
                    <?php print $member->tel ?>
                </div>
            </div>
            <form action="shop_kantan_done.php" method="post">
                <div>
                    <?php
                        print '<input type="submit" value="Order" class="back_button check_button main_button">';
                    ?>
                    <input type="button" onclick="history.back()" value="Back" class="back_button check_button">
                </div>
            </form>
        </div>
    </article>
<?php
    include("footer.php");
?>