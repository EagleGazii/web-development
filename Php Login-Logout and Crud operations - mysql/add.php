<?php
require_once ("pdo.php");
session_start();
if(!isset($_SESSION['account'])){
    die("ACCESS DENIED");
    return;
}

if(isset($_POST['add-button'])){
    if(isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])){
        if(strlen(trim($_POST['make'])) < 1 || strlen(trim($_POST['model'])) < 1 || strlen(trim($_POST['year'])) < 1 || strlen(trim($_POST['mileage'])) < 1){
            $_SESSION['error'] = "All fields are required";
            header("Location: add.php");
            return;
        }else{
            if(is_numeric($_POST['year']) && is_numeric($_POST['mileage'])){
                $sql = "INSERT INTO autos(make,model,year,mileage) VALUES (:make,:model,:year,:mileage)";
                $state = $pdo->prepare($sql);
                $statement = $state->execute(array(
                    ':make' => htmlentities($_POST['make']),
                    ':model' => htmlentities($_POST['model']),
                    ':year' => htmlentities($_POST['year']),
                    ':mileage' => htmlentities($_POST['mileage'])
                ));
                $_SESSION['success'] = "Record Added";
                header("Location: view.php");
                return;

            }else{
                $_SESSION['error'] = "Year and Mileage must be integers";
                header("Location: add.php");
                return;
            }
        }
    }
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Add - Gazmor Abdiu CRUD</title>
        <link rel="stylesheet" href="../css/index.php" type = "text/css">
    </head>
    <body>
    <?php
    if(isset($_SESSION['error'])){
        echo ("<p style = 'color:red'>".htmlentities($_SESSION['error'])."</p>");
        unset($_SESSION['error']);
    }
    
    ?>
    <form method="POST">
        <label for ="make">Make</label>
        <input type ="text" id = "make" name="make">
        <label class = "clear" for ="model">Model</label>
        <input type ="text" id = "model" name="model">
        <label class = "clear" for ="year">Year</label>
        <input type ="text" id = "year" name="year">            
        <label class = "clear" for ="mileage">Mileage</label>
        <input type ="text" id = "mileage" name="mileage">
        <input class = "clear" type="submit" name="add-button" value="Add">
        <a class = "clear" href = "index.php">Cancel</a>
    </form>
    
    </form>
    </body>
</html>