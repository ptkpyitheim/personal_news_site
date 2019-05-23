<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sign Up Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            <?php include 'css/signup.css'; ?>
        </style>
    </head>
    <body>
        <div id="body">

            <h1> Sign Up </h1>

            <hr>

            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="section newUser">
                    <label for="newUser"> Enter a new username: </label>
                    <input type="text" name="newUser" class="textfield" id="newUser" maxlength="18" placeholder="username" required>
                </div>
                
                <div class="section reEnterUser">
                    <label for="re-enter"> Re-enter your username: </label>
		            <input type="text" name="re-enter" class="textfield" id="re-enter" maxlength="18" placeholder="Re-enter" required>
                </div>

                <div class="section password">
                    <label for="password"> Enter new password: </label>
		            <input type="password" name="password" class="textfield" id="password" required>
                </div>

                <div class="section re_password">
                    <label for="re_password"> Re-enter new password: </label>
		            <input type="password" name="re_password" class="textfield" id="re_password" required>
                </div>

                <div class="section">
                    <p>Please answer two security questions.</p>
                    <label for="securityq1">What is your first pet's name?</label>
                    <input type="text" name="securityq1" class="textfield" id="securityq1" required>
                </div>
                
                <div class="section">
                    <label for="securityq2">Where is your hometown?</label>
                    <input type="text" name="securityq2" class="textfield" id="securityq2" required>
                </div>

                <div class="section">
                    <button type="submit" id="signUpBtn">Sign Up</button>
                </div>

                
                
            </form>


            <form action="login.php" method="GET" class="section">
                <button type="submit" value="" id="logInBtn">Back to Login Page</button>
            </form>
             
        

            <?php

                require 'database.php';

                if(isset($_POST['newUser'])) {
                    $newUser = $_POST['newUser'];
                    $reEnterNewUser = $_POST['re-enter'];
                    $password = $_POST['password'];
                    $re_password = $_POST['re_password'];
                    $sq1 = $_POST['securityq1'];
                    $sq2 = $_POST['securityq2'];


                    $newUser = str_replace(' ','_',$newUser);
                    $reEnterNewUser = str_replace(' ','_',$reEnterNewUser);
                    $specchar = '/[\'\/~`\!@#\$%\^&\*\(\)\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

                    if (preg_match($specchar, $newUser)) {
                        printf("<p>%s</p>", htmlentities("Please do not enter any of these special characters: /[\'^£$%&*()}{@#~?><>,|=+¬-]/'"));
                        echo "<br><p>Please re-type a new username.</p>";
                    }
                    else if($newUser != $reEnterNewUser) {
                        echo "<p>Your usernames are not the same. Please enter valid usernames.</p>";
                    }
                    else if($password != $re_password) {
                        echo "<p>Passwords do not match. Please re-enter.</p>";
                    }
                    else {

                        /* Check if username already exist */
                        $stmt = $mysqli->prepare("select username from userinformation");
                        if(!stmt) {
                            prinf("Query Prep Failed: %\n", $mysqli->error);
                            exit;
                        }
                        $stmt->execute();

                        $stmt->bind_result($name);

                        while($stmt->fetch()) {
                            if($newUser == $name) {
                                Echo "<p>Username already exists. Try another.</p>";
                                $stmt->close();
                                exit;
                            }
                        }

                        $hashed = password_hash($password, PASSWORD_DEFAULT);
                        $sq1hashed = password_hash($sq1, PASSWORD_DEFAULT);
                        $sq2hashed = password_hash($sq2, PASSWORD_DEFAULT);


                        $stmt = $mysqli->prepare("insert into userinformation (username, password, securityq1, securityq2) values (?, ?, ?, ?)");
                        if(!$stmt) {
                            printf("Query Prep Failed: %s\n", $mysqli->error);
                            exit;
                        }

                        $stmt->bind_param('ssss', $newUser, $hashed, $sq1hashed, $sq2hashed);
                        $stmt->execute();


                        $stmt->close();
                    }
                    
                    
                    
                    
                }
                
                
                
            ?>

           

        </div>
    </body>
</html>