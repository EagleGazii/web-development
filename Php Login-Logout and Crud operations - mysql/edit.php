<?php
require_once ("pdo.php");
session_start();

if(isset($_GET['autos_id'])){
    $sql = "SELECT make,model,year,mileage from autos where autos_id=:autos_id";
    $state = $pdo->prepare($sql);
    $state->execute(array(
        ':autos_id' => $_GET['autos_id']
    ));
    $row = $state->fetch();
    
    if(!($row > 1)){
        $_SESSION['error'] = "Record with id = ".$_GET['autos_id']." doesnt exist";
        header("Location: view.php");
        return;  
    }
    
    
    
    $make = $row['make'];
    $model = $row['model'];
    $year = $row['year'];
    $mileage = $row['mileage'];
    
}else{
    header("Location: view.php");
    return;  
}

if(isset($_POST['save'])){
    if(isset($_POST['make'])){
        if(trim($_POST['make']) != $make){
            $newMake = trim(htmlentities($_POST['make']));
        }
    }
    if(isset($_POST['model'])){
        if(trim($_POST['model']) != $model){
            $newModel = trim(htmlentities($_POST['model']));
        }
    }
    if(isset($_POST['year'])){
        if(is_numeric($_POST['year'])){
            if(trim($_POST['year']) != $year){
                $newYear = trim(htmlentities($_POST['year']));
            }
        }else{
            $_SESSION['error'] = "One of the Year or Mileage arent numerical";
            header("Location: edit.php?autos_id=".$_GET['autos_id']);
            return;
        }
        
    }
    if(isset($_POST['mileage'])){
        if(is_numeric($_POST['mileage'])){
            if(trim($_POST['mileage']) != $mileage){
                $newMileage = trim(htmlentities($_POST['mileage']));
            }
        }else{
            $_SESSION['error'] = "One of the Year or Mileage arent numerical";
            header("Location: edit.php?autos_id=".$_GET['autos_id']);
            return;
        }
        
    }
    if(!isset($newMake)){
        $newMake = $make;
    }
    if(!isset($newModel)){
        $newModel = $model;
    }
    if(!isset($newYear)){
        $newYear = $year;
    }
    if(!isset($newMileage)){
        $newMileage = $mileage;
    }
    if(is_numeric($newMake)){
        $_SESSION['error'] = "Make can not be an integer";
        header("Location: edit.php");
        return;
    }else{
        $sql = "UPDATE autos set make=:newMake, model=:newModel, year=:newYear, mileage=:newMileage where autos_id =:autos_id";
        $state = $pdo->prepare($sql);
        $state->execute(array(
            ':newMake' => $newMake,
            ':newModel' => $newModel,
            ':newYear' => $newYear,
            ':newMileage' => $newMileage,
            ':autos_id' => $_GET['autos_id']
        ));
        $_SESSION['success'] = "Record edited";
        header("Location: index.php");
        return;
    }
    

}

?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edit - Gazmor Abdiu CRUD</title>
        <link rel="stylesheet" href="../css/index.php" type = "text/css">
    </head>
    <body>
    <?php
        if(isset($_SESSION['success'])){
            echo ("<p style = 'color:green'>".htmlentities($_SESSION['success'])."</p>");
            unset($_SESSION['success']);
        }
        if(isset($_SESSION['error'])){
            echo ("<p style = 'color:red'>".htmlentities($_SESSION['error'])."</p>");
            unset($_SESSION['error']);
        }
    ?>
    <form method="POST">
        <label for ="make">Make</label>
        <input type ="text" id = "make" name="make" value = '<?echo $make?>'>
        <label class = "clear" for ="model">Model</label>
        <input type ="text" id = "model" name="model" value = '<?echo $model?>'>
        <label class = "clear" for ="year">Year</label>
        <input type ="text" id = "year" name="year" value = '<?echo $year?>'>            
        <label class = "clear" for ="mileage">Mileage</label>
        <input type ="text" id = "mileage" name="mileage" value = '<?echo $mileage?>'>
        <input class = "clear" type="submit" name="save" value="Save">
        <a class = "clear" href = "index.php">Cancel</a>
    </form>
    </body>
</html>