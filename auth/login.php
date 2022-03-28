<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/checkInput.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Guitar | Login Logout</title>
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/auth.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/alertify.min.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/default.min.css" type="text/css">

</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <?php
            if(isset($_SESSION['username'])){
                $username = $_SESSION['username'];
            }
            if (isset($_POST['submit'])) {
                $username = trim($_POST['username']);
                $password = md5(trim($_POST['password']));

                $queryGetUser = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
                $result = $conn->query($queryGetUser);
                $arUser = $result->fetch_assoc();
                if ($result->num_rows > 0) {
                    $_SESSION['arUser'] = $arUser;
                    if (isset($_SESSION['back'])) {
                        header("Location:{$_SESSION['back']}");
                    } else {
                        header("Location:/SHOP_GUITAR");
                    }
                } else {
                    $error =  "Sai username hoặc password";
                }
            }
            ?>
            <form action="#" method="POST">
                <h2>Sign in</h2>
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="username" id="username" value="<?php echo (isset($username)? $username : "");?>"/>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Name" id="password" />
                <button name="submit">Sign In</button>
                <?php
                if (isset($error)) {
                ?>
                    <span class="error mt-2 align-self-center"><?php echo $error; ?></span>
                <?php
                }
                ?>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <a href="signup.php"><button class="ghost" id="signIn">Sign In</button></a>

                </div>
            </div>
        </div>
    </div>

    <footer>
        Bui Duc Tuan - Lap trinh php | Shop Guitar
    </footer>
    <script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/SHOP_GUITAR/templates/shop/assets/js/alertify.min.js"></script>
    <script>
        if (<?php echo $_SESSION['createAcount']; ?>) {
            alertify.success('Tạo tài khoản thành công');
            <?php
            unset($_SESSION['createAcount']);
            ?>
        } else {
            alertify.danger('Tạo tài khoản thất bại');
            <?php
            unset($_SESSION['createAcount']);
            ?>
        }
    </script>
</body>

</html>