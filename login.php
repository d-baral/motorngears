<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MotorNGears | Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="heading">
                <p id="logo-id">
                    <a href='index.php'><img src="./assets/pics/mnglogo.png"></a>
                </p>
                <p class="title">
                    LOGIN
                </p>
            </div>

            <?php
            session_start();

            if (isset($_SESSION['message'])) {
                ?>
            <div class="error">
                <?php echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
            </div>
            <?php
            }
            ?>
            <form id="loginform" method="POST" action="login_action.php">
                <label>
                    <i class="fa fa-user-circle-o" style="color: var(--primary);"></i>
                    <b>User Name</b>
                </label>
                <input type="text" placeholder="Enter your User Name" name="user_name" id="user_name" required>
                <label>
                    <i class="fa fa-key" style="color: var(--primary);"></i>
                    <b>Password</b>
                </label>
                <input type="password" placeholder="Enter your Password" name="password" id="password">

                <button class="button" name="loginbutton">
                    LOGIN
                </button>
                <p>
                    Don't have an account?
                    <span>
                        <a href="signup.php">SIGN UP</a>
                    </span>
                </p>
            </form>
        </div>
    </div>
</body>

</html>