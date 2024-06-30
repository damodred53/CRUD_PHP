<?php

    require_once "connexion.php";

    $id = $_GET['id'];

    $req = mysqli_query($con, "DELETE FROM Employee WHERE id=$id" );

    header("Location:index.php");
    
?>