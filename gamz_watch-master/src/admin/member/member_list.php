<?php
    include "../includes/header.php";

    $memberList = getAllMemberList();
?>
<div class="col-sm-12">
    <h2>Member List</h2>
    <form action="member_branch.php" method="post">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Code</th>
                <th>Code</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
            </thead>
            <tbody>
                <?php for($i = 0; $i < count($memberList); $i++){ ?>
                    <tr>
                        <td><input type="radio" name="member_code" value="<?php echo $memberList[$i]->code; ?>"></td>
                        <td><?php echo $memberList[$i]->code ?></td>
                        <td><?php echo $memberList[$i]->name ?></td>
                        <td><?php echo $memberList[$i]->email ?></td>
                        <td><?php echo $memberList[$i]->date ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <input type="submit" name="disp" value="Disp" class="btn">
        <input type="submit" name="edit" value="Fix" class="btn">
    </form>
    <a href="../staff_login/staff_top.php">To top</a>
</div>
    
</body>
</html>