<?php
session_start();

if(isset($_POST['email']) && isset($_POST['pass'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);
    if(strlen($email) < 1 || strlen($password) < 1 ){
        $_SESSION['error'] = "User name and password are required";
    }else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format";
        }else{
            if($password == "php123" && $email == "umsi@umich.edu"){
                $_SESSION['success'] = "You Login successfully";
                $_SESSION['account'] = true;
                header("Location: index.php");
                return;

            }else{
                $_SESSION['error'] = "Your email or password was wrong, try again";
            }
        }
    }
}





?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login - Gazmor Abdiu CRUD</title>
        <link rel="stylesheet" href="../css/index.php" type = "text/css">
    </head>
    <body>
    <?php
        if(isset($_SESSION['error'])){
            echo ("<p style = 'color:red'>".$_SESSION['error']."</p>");
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
            echo ("<p style = 'color:green'>".$_SESSION['success']."</p>");
            unset($_SESSION['success']);
        }
    ?>
        <form method="POST">
            <label for ="email">Email</label>
            <input type ="text" id = "email" name="email"><br>
            <label class = "clear" for="pass">Password</label>
            <input type="text" id = "pass" name="pass"><br>
            <input class = "clear" type="submit" name="submit-button" value="Log In">
            <a class = "clear" href = "index.php">Cancel</a>
        </form>
    </body>
</html>