<?php
    session_start();
    
    require("connexionemployeur.php");

    $c= new PDO($host,$login,$password);
    $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $Email=$_SESSION['email']; 
    $acc=new AccesMesannonces($c,$Email);
    $appli=new Appli($acc);
    $appli->moteur($acc); 

?>