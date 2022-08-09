<?php

    require("connexion.php");

    
    $c= new PDO($host,$login,$password);
    $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    

    $req=$c->prepare("DELETE FROM Client WHERE Email_client=?");
    $req->execute([$_SESSION['email']]);
    echo "Compte supprimé...";
    echo "<a href=index.php> Retour à l'accueil </a>";
                
?>