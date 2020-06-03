<?php
    require_once("header.php");
    $member = unserialize($_SESSION[SESSION_CON::$MEMBER_ENTITY]);
?>

<article id="member_info">
    <div class="content_width">
        <h2>Member infomation</h2>
        <div class="name box">
            <h3>Name</h3>
            <div>
                <?php print $member->name; ?>
            </div>
        </div>
        <div class="email box">
            <h3>Email</h3>
            <div>
                <?php print $member->email; ?>
            </div>
        </div>
        <div class="postal box">
            <h3>Postal</h3>
            <div>
                <?php print $member->postal1; ?>
                -
                <?php print $member->postal2; ?>
            </div>
        </div>
        <div class="address box">
            <h3>Address</h3>
            <div>
                <?php print $member->address; ?>
            </div>
        </div>
        <div>
            <a href="member_info_edit.php" class="back_button fix_button">Edit infomation</a>
        </div>
        <div>
            <input type="button" onclick="history.back()" value="back" class="back_button fix_button">
        </div>
    </div>
</article>

<?php
    require_once("footer.php");
?>