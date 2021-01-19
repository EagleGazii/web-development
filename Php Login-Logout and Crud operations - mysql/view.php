<?php
require_once('pdo.php');
session_start();
    if(!isset($_SESSION['account'])){
        die("ACCESS DENIED");
    }
    


?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>View - Gazmor Abdiu CRUD</title>
        <link rel="stylesheet" href="../css/index.php" type = "text/css">
    </head>
    <body>
    <h1>Welcome to the Automobilies Database</h1>
    <?php
    if(isset($_SESSION['error'])){
        echo ("<p style = 'color:red'>".htmlentities($_SESSION['error'])."</p>");
        unset($_SESSION['error']);
    }
    $sql = "SELECT * from autos";
    $countSql = "SELECT count(autos_id) from autos";
    try{
        $countData = $pdo->query($countSql)->fetchColumn();
    }catch(Exception $ex){
        error_log("Autos table data counting in myslq unssuccesful : ".$ex);
        echo ("Something happening with counting autos datatable ");
        die();
    }
    
    
    
    if($countData != 0){
    echo ("<table border = '1'>");
    echo ("<tr><th>");
    echo ("Make");
    echo ("</th><th>");
    echo ("Model");
    echo ("</th><th>");
    echo ("Year");
    echo ("</th><th>");
    echo ("Mileage");
    echo ("</th><th>");
    echo ("Action");
    echo ("</th></tr>");
    try{
        $statement =$pdo->query($sql);
    }catch(Exception $ex){
        error_log("Autos table data reading in myslq unssuccesful : ".$ex);
        echo ("Something happening with reading autos datatable");
        die();
    }
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        echo ("<tr><td>");
        echo (htmlentities($row['make']));
        echo ("</td><td>");
        echo (htmlentities($row['model']));
        echo ("</td><td>");
        echo (htmlentities($row['year']));
        echo ("</td><td>");
        echo (htmlentities($row['mileage']));
        echo ("</td><td>");
        echo ('<a href ="edit.php?autos_id=' . $row['autos_id'].'" >Edit</a> / ');
        echo ('<a href ="delete.php?autos_id=' . $row['autos_id'].'" >Delete</a>');
        echo ("</td></tr>");
    }
    echo ("</table>");
    }else{
        echo ("<h2>No rows found</h2><br>");
    }
    
    
    ?>
    <a href = "add.php">added</a></br>
    <a href = "logout.php">Logout</a>
    
    
    
    
    </body>
</html>