<?php
    require("connexionemployeur.php");

    if(isset($_POST['valider']))
    {
        if(empty($_POST['titre']) or empty($_POST['type_emploi']) or empty($_POST['localisation']) or empty($_POST['descriptif']))
            {
				echo "Un des champs n'est pas complété.";
                echo "<a href=annonceform.tpl.html> Pour retourner au formulaire de nouvelle annonce cliquer ici </a>";
			} 
            else 
            {
                $c= new PDO($host,$login,$password);
                $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				
                if(!$c) 
                {
				    echo "Erreur de connexion à la base de données.";
                    echo "<a href=annonceform.tpl.html> Pour retourner au formulaire de nouvelle annonce cliquer ici </a>";
				} 
                else 
                {
                    $Titre=$_POST['titre'];
                    $Type_emploi=$_POST['type_emploi'];
                    $Localisation=$_POST['localisation'];
				    $Descriptif=$_POST['descriptif'];
                    $Email=$_SESSION['email'];
				    
                    $req=$c->prepare("INSERT INTO Annonces VALUES (0,?, ?, ?, ?,  ?)");
                    $req->execute([$Titre,$Type_emploi,$Localisation,$Descriptif,$Email]);
                    echo "Annonce enregistrée !";
                    echo ' <a href=mesannonces.php> Pour retrouver la liste de toutes vos annonces cliquer ici. </a>';
	
                    }
            }
    }
						
?>