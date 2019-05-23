<!DOCTYPE html>

<html lang="en"> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>LogIn</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            <?php include 'css/login.css'; ?>
        </style>
    </head>
    <body>

        <div id="body">
            <h1>Hi there!</h1>
            <h2>Please sign up with a new username or login.</h2>

            <div class="wrap">
                <form action="signup.php" method="POST">
                    <button type="submit" value="signup" id="signupBtn">Sign Up</button>
                </form>

                <form action="home.php" action="POST">
                    <button type="submit" id="loginAsGuest">Guest User Login</button>
                </form>
            </div>
            
            <hr>


            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" id="loginForm">
                <div class="inputfields">
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username" placeholder="username" required>
                </div>
                <div class="inputfields">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" required>
                </div>

                <button type="submit" id="loginBtn">Login</button>
            </form>

            <form action="reset_password.php" method="POST">
                <button type="submit" value="reset" id="resetBtn">Forgot your password?</button>
            </form>


            <?php
                require 'database.php';

                if(isset($_POST['username'])){

                    /* preparing statment */
                    $stmt = $mysqli->prepare("Select count(*), password from userinformation where username=?");

                    /* Binding the parameter */
                    $stmt->bind_param('s',$username);
                    $username = $_POST['username'];
                    $stmt->execute();

                    /* Binding the results */
                    $stmt->bind_result($cnt, $pwd_hash);
                    $stmt->fetch();

                    $pwd_guess = $_POST['password'];
                    /* Compare the submitted password to the actual password hash */

                    if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)) {
                        echo "Login Succeded";
                        /* Redirect to home page */
                        session_start();
                        $_SESSION['user'] = $username;       

                        header('Location: home.php');
                        exit;
                    }
                    else {
                        echo "<p>Login failed</p>";
                    }
                }
            ?>
        
        </div>
        
       

 
    </body>
</html>