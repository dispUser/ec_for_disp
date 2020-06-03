<?php
    include "../includes/header.php";
    
    $staff_code = $_POST['code'];
    $staff_name = $_POST['name'];
    $staff_pass = $_POST['pass'];
    $staff_pass2 = $_POST['pass2'];

    // 安全対策
    $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
    $staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');
    $staff_pass2 = htmlspecialchars($staff_pass2, ENT_QUOTES, 'UTF-8');

    $hasError = false;

    if($staff_name == ''){
        $hasError = true;
        $staff_name = "Staff Name is empty";
    }

    $disp_pass = "";
    if($staff_pass == ''){
        $hasError = true;
        $disp_pass = "Password is empty";    
    }else if($staff_pass2 == ''){
        $hasError = true;
        $disp_pass = "Re Password is empty";
    }else if($staff_pass2 != $staff_pass){
        $hasError = true;
        $disp_pass = "Passwords doesn't match";
    }else{
        $disp_pass = "Password is collect";
    }
    
?>
    <div class="col-sm-12">
        <h2>Staff edit check</h2>
        <form action="staff_edit_done.php" method="post">
            <h3>Name</h3>
            <div>
                <?php echo $staff_name; ?>
            </div>
            <h3>Password</h3>
            <div>
                <?php echo $disp_pass; ?>
            </div>
        <?php if($hasError){ ?>
            <input type="button" onclick="history.back()" value="Back">
        <?php }else{ ?>
            <input type="hidden" name="code" value="<?php echo $staff_code; ?>">
            <input type="hidden" name="name" value="<?php echo $staff_name; ?>">
            <input type="hidden" name="pass" value="<?php echo $staff_pass; ?>">
            <input type="button" onclick="history.back()" value="Back" class="btn btn-secondary">
            <input type="submit" value="OK" class="btn btn-success">
        <?php } ?>
        </form>
    </div>


</body>
</html>