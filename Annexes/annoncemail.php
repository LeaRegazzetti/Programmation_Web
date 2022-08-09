<?php

    // Entête HTML
    include("entete.inc.html");

    // Appel au fichier de connexion
    require("connect.inc.php");
    require("projetmodele.class.php");
    require("projetcontroleur.class.php");

    //Gestion des erreurs
    try
    {
        $c= new PDO($host,$login,$password);
        $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $acc=new AccesAnnoncesMail($c);
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