<?php
    include "../includes/header.php"
?>
     <h1>New Category</h1>
     <form action="category_add_check.php" method="post" enctype="multipart/form-data">
        <p>Category Name</p>
        <input type="text" name="name">
        <div>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </div>
     </form>
</body>
</html>