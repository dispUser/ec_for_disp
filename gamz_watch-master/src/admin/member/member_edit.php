<?php
    include "../includes/header.php";

    $member_code = intval($_GET['member_code']);
    $member = getMemberByCode($member_code);
?>
<div class="col-sm-12">
    <form action="member_edit_check.php" method="post">
        <h2>Member List</h2>
        <h3>Code</h3>
        <div>
            <?php echo $member->code ?>
            <input type="hidden" name="code" value="<?php echo $member->code ?>">
        </div>
        <h3>Name</h3>
        <div>
            <input type="text" name="name" value="<?php echo $member->name ?>">
        </div>
        <h3>Email</h3>
        <div>
            <input type="text" name="email" value="<?php echo $member->email ?>">
        </div>
        <h3>Date</h3>
        <div>
            <?php echo $member->date ?>
        </div>
        <h3>postal</h3>
        <div>
            <input type="text" name="postal1" value="<?php echo $member->postal1 ?>"> - <input type="text" name="postal2" value="<?php echo $member->postal2 ?>">
        </div>
        <h3>Address</h3>
        <div>
            <input type="text" name="address" value="<?php echo $member->address ?>">
        </div>
        <h3>Tel</h3>
        <div>
            <input type="text" name="tel" value="<?php echo $member->tel ?>">
        </div>
        <h3>Password</h3>
        <div>
            <input type="password" name="password1" value="">
        </div>
        <h3>Re Password</h3>
        <div>
            <input type="password" name="password2" value="">
        </div>
        <div>
            <input type="button" onclick="history.back()" value="Back" class="btn">
            <input type="submit" value="OK" class="btn">
        </div>
    </form>
</div>
    
</body>
</html>