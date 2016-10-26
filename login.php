<?php
session_start();
//echo md5('adminpassword');
$message = '';

if(isset($_GET['logout'])){
    $_SESSION['user_id'] = 0;
    $message = "You are logged out.";
} else if(isset( $_SESSION['user_id']) &&  $_SESSION['user_id'] == 1) {
    $message = "You are logged in.";
} else if(isset($_POST['username']) && isset($_POST['password'])){
    if($_POST['username'] == "adminuser" && md5($_POST['password']) == "e3274be5c857fb42ab72d786e281b4b8"){
        $_SESSION['user_id'] = 1;
        $message = "You are logged in.";
    } else $message = "wrong username password";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!--      <base href="/room/">-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
</head>

<body>
    <div>
        <div>
            <div class="">
                <form class="form-horizontal" method="post" action="login.php">
                    <div class="form-group">
                        <a href="login.php?logout=true">Logout</a>
                        <?php echo $message;?>
                        <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="username" id="inputEmail3" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
