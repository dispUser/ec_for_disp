<?php
    include "../includes/header.php";

    $member_code = intval($_GET['member_code']);
    $member = getMemberByCode($member_code);
?>
<div class="col-sm-12">
    <h2>Member List</h2>
    <h3>Code</h3>
    <div>
        <?php echo $member->code ?>
    </div>
    <h3>Name</h3>
    <div>
        <?php echo $member->name ?>
    </div>
    <h3>Email</h3>
    <div>
        <?php echo $member->email ?>
    </div>
    <h3>Date</h3>
    <div>
        <?php echo $member->date ?>
    </div>
    <h3>postal</h3>
    <div>
        <?php echo $member->postal1 ?> - <?php echo $member->postal2 ?>
    </div>
    <h3>Address</h3>
    <div>
        <?php echo $member->address ?>
    </div>
    <h3>Tel</h3>
    <div>
        <?php echo $member->tel ?>
    </div>
    <div>
        <a href="member_list.php">To top</a>
    </div>
</div>
    
</body>
</html>