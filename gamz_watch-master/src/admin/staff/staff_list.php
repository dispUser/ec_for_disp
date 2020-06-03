<?php
    include "../includes/header.php";

    $staffList = getAllStaffList();
?>
    <div class="col-sm-12">
        <h2>Staff list</h2>
        <form action="staff_branch.php" method="post">
            <table class="table table-bordered table-hover">
                <thead>
                    <th>Code</th>
                    <th>Name</th>
                </thead>
                <tbody>
                <?php for($i = 0; $i < count($staffList); $i++){ ?>
                    <tr>
                        <td>
                            <input type="radio" name="staffcode" value="<?php echo $staffList[$i]->code; ?>">
                            <?php echo $staffList[$i]->code; ?>
                        </td>
                        <td>
                            <?php echo $staffList[$i]->name; ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <input class="btn btn-success" type="submit" name="disp" value="Disp">
            <input class="btn btn-success" type="submit" name="add" value="Add">
            <input class="btn btn-success" type="submit" name="edit" value="Edit">
            <input class="btn btn-danger" type="submit" name="delete" value="Delete">
        </form>
        <div>
            <a href="../staff_login/staff_top.php">To top</a>
        </div>
    </div>

</body>
</html>