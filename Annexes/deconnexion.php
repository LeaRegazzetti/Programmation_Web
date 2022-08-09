<?php
    include("entete.inc.html");
    session_start();
    $_SESSION = array();
    session_destroy();
    echo "Vous vous êtes déconnecté.";
    echo "<a href=index.php> Retour à l'accueil </a>";
?>