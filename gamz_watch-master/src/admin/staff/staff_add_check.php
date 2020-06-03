<?php
    include "../includes/header.php"
?>
    <?php
        $staff_name=$_POST['name'];
        $staff_pass=$_POST['pass'];
        $staff_pass2=$_POST['pass2'];

        // 安全対策
        $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
        $staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');
        $staff_pass2 = htmlspecialchars($staff_pass2, ENT_QUOTES, 'UTF-8');


        $hasError = false;

        if($staff_name == ''){
            $hasError = true;
            $staff_name = 'Name is empty';
        }

        if($staff_pass == ''){
            $hasError = true;
            $staff_pass = 'password is empty';
        }

        if($staff_pass2 != $staff_pass){
            $hasError = true;
            $staff_pass = 'password doesn\'t match';
        }

    ?>
    <div class="col-sm-12">
        <h2>Staff edit check</h2>
        <h3>Name</h3>
        <div>
            <?php echo $staff_name; ?>
        </div>
        <h3>Password</h3>
        <div>
            <?php if($hasError){ ?>
                <?php echo $staff_pass; ?>
            <?php }else{ ?>
                <?php echo "Password is valid" ?>
            <?php } ?>
        </div>
        <?php if($hasError){ ?>
            <input type="button" onclick="history.back()" value="back" class="btn btn-secondary">
        <?php }else { ?>
            <?php $staff_pass = encrypt($staff_pass); ?>
            <form action="staff_add_done.php" method="post">
                <input type="hidden" name="name" value="<?php echo $staff_name; ?>">
                <input type="hidden" name="pass" value="<?php echo $staff_pass; ?>">
                <input type="button" onclick="history.back()" value="back" class="btn btn-secondary">
                <input type="submit" value="OK" class="btn btn-success">
            </form>
        <?php } ?>
    </div>
</body>
</html>