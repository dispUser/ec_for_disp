<?php
    include "../includes/header.php"
?>
    <?php
        $staff_code = $_POST['code'];
        $staff_name = $_POST['name'];
        $staff_pass = $_POST['pass'];

        // 安全化
        $staff_code = htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8');
        $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
        $staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');

        $staff = new Staff;
        $staff->code = $staff_code;
        $staff->name = $staff_name;
        $staff->password = $staff_pass;

        execUpdateStaff($staff);
    ?>
    <div class="col-sm-12">
        <h2>Staff update done</h2>
        <div class="form-group">
            <a href="staff_list.php" class="btn btn-secondary">Back to list</a>
        </div>
    </div>
</body>
</html>