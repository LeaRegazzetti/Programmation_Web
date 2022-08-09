<?php
    
    session_start();
    require("connexionemployeur.php");

    //Gestion des erreurs
    try
    {

        $Email=$_SESSION['email'];
        $c= new PDO($host,$login,$password);
        $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $acc=new AccesEmp($c,$Email);
        $appli=new Appli($acc);
        $appli->moteur($acc);

    } 
    catch(PDOException $erreur)
    {
        echo $erreur->getMessage();
    }


    // Pied de page HTML
    include("pied.inc.html");
?>