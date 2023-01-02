<?php 
session_start();
?>
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
                        SIGN UP
                    </p>
                </div>
                <form id="signupform" action="login_action.php" method="POST"> 
                    <label>
                        <i class="fa fa-user-circle-o" style="color: var(--primary);"></i>
                        <b>User Name</b>
                    </label>
                    <input
                        type="text"
                        placeholder="Enter your User Name"
                        name="user_name"
                        id="user_name"
                        required
                    >
                    <label>
                        <i class="fa fa-envelope" style="color: var(--primary);"></i>
                        <b>Email</b>
                    </label>
                    <input
                        type="email"
                        placeholder="Enter your Email"
                        name="email"
                        id="email"
                        required
                    >
                    <label>
                        <i class="fa fa-key" style="color: var(--primary);"></i>
                        <b>Password</b>
                    </label>
                    <input
                        type="password"
                        placeholder="Enter your Password"
                        name="password"
                        id="password"
                    >
                    <?php
                   if(isset($_SESSION['suc_message']))
                   {
                    ?>
                    <div class="success">
                    <?php echo $_SESSION['suc_message']; 
                    unset($_SESSION['suc_message']);
                    ?>
                    </div>
                    <?php 
                   }
                    ?>
                     <button class="button" name="signupbutton">
                        SIGN UP
                    </button>  
                    <p>
                        Already have an account?
                        <span>
                            <a href="login.php">LOGIN</a>
                        </span>
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>
