<?php
session_start();
$text;
try{
    require_once('pdo.php');
    if(isset($_GET['autos_id'])){
        $sql = "SELECT * from autos where autos_id=:autos_id";
        $state = $pdo->prepare($sql);
        $state->execute(array(
            ':autos_id' => $_GET['autos_id']
        ));
        $row = $state->fetch(PDO::FETCH_ASSOC);
        $text= "<a>Confirm if you want to delete the item <br>Make: ".$row['make']."<br>Model: ".$row['model']."<br>Year: ".$row['year']."<br>Mileage: ".$row['mileage'] ."</a>";


    }

    if(isset($_POST['delete'])){
        $sql = "Delete from autos where autos_id=:autos_id";
        $state = $pdo->prepare($sql);
        $statement = $state->execute(array(
            ':autos_id' => $_GET['autos_id'] + 0
        ));

        $_SESSION['success'] = "Record deleted";
        header("Location: index.php");
        return;
    }
}catch(Exception $ex){
    error_log("Something happening with delete");
    $_SESSION['error'] = "Record undeleted";
    header("Location: index.php");
    return;
}

    




?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Delete - Gazmor Abdiu CRUD</title>
        <link rel = "stylesheet" href="../css/index.php" type = "text/css">
    </head>
    <body>
        <form method="POST">
            <lable><?php
                if(isset($text)){
                    echo $text;
                }
            ?></label>
            <input type = "submit" name = "delete" value = "Delete" class = "clear">
            <a href = "view.php">Cancel</a>
        
        </form>
    </body>
</html> 