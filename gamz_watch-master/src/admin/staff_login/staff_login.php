<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gamz Watch Online</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="col-sm-12">
        <h1>Staff Login</h1>
        <div class="col-sm-6">
            <form action="staff_login_check.php" method="post">
                <div class="form-group">
                    <label>
                        Staff code
                    </label>
                    <input class="form-control" type="text" name="code">
                </div>
                <div class="form-group">
                    <label>
                        Password
                    </label>
                    <input class="form-control" type="password" name="pass">
                </div>
                <div>
                    <input type="submit" value="Login" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</body>
</html>