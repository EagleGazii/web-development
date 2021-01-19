<?php
session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Index - Gazmor Abdiu CRUD</title>
        <link rel="stylesheet" href="../css/index.php" type = "text/css"> 
    </head>
    <body>
    <h1>Welcome to the Automobilies Database</h1>
    <?php
        if(isset($_SESSION['success'])){
            echo ("<p style = 'color:green'>".($_SESSION['success'])."</p>");
            unset($_SESSION['success']);
        }
        if(isset($_SESSION['error'])){
            echo ("<p style = 'color:red'>".htmlentities($_SESSION['error'])."</p>");
            unset($_SESSION['error']);
        }
    
        if(isset($_SESSION['account'])){
            echo ("<a href = 'add.php'>Add New Entry</a><br>");
            echo ("<a href = 'view.php'>View</a><br>");
            echo ("<a href = 'logout.php'>Logout</a><br>");
            
        }else{
            
            echo ("<a href = 'login.php'>Please log in</a><br>");
        }
    
    ?>
    </body>
</html>