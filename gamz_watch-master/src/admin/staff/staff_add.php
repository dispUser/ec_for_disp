<?php
    include "../includes/header.php"
?>
    <div class="col-sm-12">
        <h2>Add Staff</h2>
        <form action="staff_add_check.php" method="post">
            <div class="form-group">
                <label>Staff Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" class="form-control">
            </div>
            <div class="form-group">
                <label>Re password</label>
                <input type="password" name="pass2" class="form-control">
            </div>
            <div>
                <input type="button" onclick="history.back()" value="Back" class="btn btn-secondary">
                <input type="submit" value="OK" class="btn btn-success">
            </div>
        </form>
    </div>
</body>
</html>