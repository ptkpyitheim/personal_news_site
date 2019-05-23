<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Reset Password</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            <?php include 'css/reset.css'; ?>
        </style>
    </head>
    <body>
        <div id="body">

            <h1> Forgot your password? </h1>

            <hr>

            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="section username">
                    <label for="username"> Enter your username: </label>
                    <input type="text" name="username" class="textfield" id="username" maxlength="18" placeholder="username" required>
                </div>

                <div class="section new_password">
                    <label for="new_password"> Enter new password: </label>
		            <input type="password" name="new_password" class="textfield" id="new_password" required>
                </div>

                <div class="section re_new_password">
                    <label for="re_new_password"> Re-enter new password: </label>
		            <input type="password" name="re_new_password" class="textfield" id="re_new_password" required>
                </div>

                <p> Answer your security questions below. </p>

                <div class="section">
                    <label for="securityq1">What is your first pet's name?</label>
                    <input type="text" name="securityq1" class="textfield" id="securityq1" required>
                </div>
                
                <div class="section">
                    <label for="securityq2">Where is your hometown?</label>
                    <input type="text" name="securityq2" class="textfield" id="securityq2" required>
                </div>

                <div class="section">
                    <button type="submit" id="resetBtn">Reset Password</button>
                </div>

                
                
            </form>


            <form action="login.php" method="GET" class="section">
                <button type="submit" value="" id="logInBtn">Back to Login Page</button>
            </form>
             
        

            <?php

                require 'database.php';

                if(isset($_POST['username'])) {
                    $user = $_POST['username'];
                    $new_password = $_POST['new_password'];
                    $re_new_password = $_POST['re_new_password'];
                    /* $sq1 = $_POST['securityq1'];
                    $sq2 = $_POST['securityq2']; */


                    $user = str_replace(' ','_',$user);
                    $reEnterNewUser = str_replace(' ','_',$reEnterNewUser);
                    $specchar = '/[\'\/~`\!@#\$%\^&\*\(\)\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

                    if (preg_match($specchar, $user)) {
                        printf("<p>%s</p>", htmlentities("Please do not enter any of these special characters: /[\'^£$%&*()}{@#~?><>,|=+¬-]/'"));
                        echo "<br><p>Please re-type a new username.</p>";
                    }
                    else if($new_password != $re_new_password) {
                        echo "<p>Passwords do not match. Please re-enter.</p>";
                    }
                    else {

                        /* Check if username already exist */
                        $stmt = $mysqli->prepare("Select username from userinformation");
                        if(!stmt) {
                            prinf("Query Prep Failed: %\n", $mysqli->error);
                            exit;
                        }

                        $stmt->execute();
                        $stmt->bind_result($name);

                        $hasFoundUser = false;

                        while($stmt->fetch()) {
                            if($user == $name) {
                                echo 'Userfound';
                                $hasFoundUser = true;
                                break;
                            }
                        }

                        if(!$hasFoundUser) {
                            Echo "<p>Username does not exist. Make sure your username is correct.</p>";
                            exit;
                        }

                        $stmt->close();


                        /* preparing statment to check security questions */
                        $query = $mysqli->prepare("Select securityq1, securityq2 from userinformation where username=?");
                        if(!$query) {
                            printf("Query Prep Failed: %s\n", $mysqli->error);
                            exit;
                        }

                        /* Binding the parameter */ 
                        $query->bind_param('s',$check_user);
                        $check_user = $_POST['username'];
                        $query->execute();

                        /* Binding the results */
                        $query->bind_result($sq1_hash, $sq2_hash);
                        $query->fetch();
                        $query->close();

                        $sq1_guess = $_POST['securityq1'];
                        $sq2_guess = $_POST['securityq2'];

                        /* Compare if the security questions are correctly answered */
                        if(password_verify($sq1_guess, $sq1_hash) && password_verify($sq2_guess, $sq2_hash)) {    
                            echo '<p> Security questions are correct. </p>';
                            /* Update new password with that user name */
                            $hashed = password_hash($new_password, PASSWORD_DEFAULT);

                            $password_prep = $mysqli->prepare("UPDATE userinformation SET password=? WHERE username=?");
                            if(!$password_prep) {
                                printf("Query Prep Failed Failllllaa: %s\n", $mysqli->error);
                                exit;
                            }

                            $password_prep->bind_param('ss', $hashed, $theuser);
                            $theuser = $_POST['username'];
                            $password_prep->execute();
                        }
                        else {
                            echo '<p> Security answers are incorrect. </p>';
                        }

                        $password_prep->close();
                    }
                    
                }
                
            ?>

        </div>
    </body>
</html>