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
    if($_POST['username'] == "adminuser" && md5($_POST['password']) == "e3274be5c857fb42ab72d786e281b4b8"){ //adminpassword
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading {
            margin-bottom: 10px;
        }

        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body>

    <div class="container">
        <form class="form-signin" method="post" action="login.php">
            <h3 class="form-signin-heading">Please sign in</h3>
            <label for="inputUsername" class="sr-only">User name</label>
            <input id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            <div class="text-sm-center">
                <label>
                    <?php echo $message;?>
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <a class="btn btn-lg btn-danger btn-block" href="login.php?logout=true">Logout</a>
        </form>
    </div> <!-- /container -->

</body>
</html>
