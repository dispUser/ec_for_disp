<?php
    require_once("header.php");
    $member = unserialize($_SESSION[SESSION_CON::$MEMBER_ENTITY]);
?>

<article id="member_info_edit">
    <div class="content_width">
        <h2>Edit member infomation</h2>
        <form action="member_info_edit_check.php" method="post">
            <div class="name box">
                <h3>Name</h3>
                <input type="text" name="name" value="<?php print $member->name; ?>">
            </div>
            <div class="email box">
                <h3>Email</h3>
                <input type="email" name="email" value="<?php print $member->email; ?>">
            </div>
            <div class="postal box">
                <h3>Postal</h3>
                <input type="text" name="postal1" value="<?php print $member->postal1; ?>">
                -
                <input type="text" name="postal2" value="<?php print $member->postal2; ?>">
            </div>
            <div class="address box">
                <h3>Address</h3>
                <input type="text" name="address" value="<?php print $member->address; ?>">
            </div>
            <input type="submit" value="Check" class="back_button fix_button submit_button">
            <div>
                <input type="button" onclick="history.back()" value="back" class="back_button fix_button">
            </div>
        </form>
    </div>
</article>

<?php
    require_once("footer.php");
?>