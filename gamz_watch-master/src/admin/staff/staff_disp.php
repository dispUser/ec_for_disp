<?php
    include "../includes/header.php"
?>
    <?php
        $staff_code = $_GET['staffcode'];
        $staffList = getStaffByCode($staff_code);
        $staff;
        if(count($staffList) == 0){
            print "No member";
            exit();
        }else{
            $staff = $staffList[0];
        }

    ?>
    <div class="col-sm-12">
        <h2>Staff Disp</h2>
        <div>Staff Code</div>
        <div>
            <?php print $staff_code; ?>
        </div>
        <div>Staff Name</div>
        <div>
            <?php print $staff->name; ?>
        </div>
        <form action="staff_edit_check.php" method="post">
            <div class="form-group">
                <input type="button" onclick="history.back()" value="Back" class="btn btn-secondary">
            </div>
        </form>
    </div>
</body>
</html>