<?php
    require("connect.inc.php");
    include("entete.inc.html");
    require("projetmodele.class.php");
    require("projetcontroleur.class.php");

    if(isset($_POST['inscription']))
    {
        if(empty($_POST['prenom']) or empty($_POST['nom']) or empty($_POST['societe']) or empty($_POST['email']) or empty($_POST['pwd']))
            {
				echo "Un des champs n'est pas complété.";
                echo "<a href=inscriptionemployeurform.tpl.html> Pour retourner au formulaire d'inscription cliquer ici </a>";
			} 
            else 
            {
                $c= new PDO($host,$login,$password);
                $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				
                if(!$c) 
                {
				    echo "Erreur de connexion à la base de données.";
                    echo "<a href=inscriptionmemployeurform.tpl.html> Pour retourner au formulaire d'inscription cliquer ici </a>";
				} 
                else 
                {
                    $Prenom=$_POST['prenom'];
                    $Nom=$_POST['nom'];
                    $Societe=$_POST['societe'];
				    $Email=$_POST['email'];
				    $Mdp=password_hash($_POST['pwd'], PASSWORD_DEFAULT);;
				    
                    $res =$c->query("SELECT COUNT(*) FROM Employeurs WHERE Email_emp = '".$Email."'")->fetch();
                    
                    if ($res['COUNT(*)'] == 1)
                    {

				        echo "Cet email est déjà utilisé, veuillez en choisir un autre ou vous connecter.";
                        echo "<a href=inscriptionemployeurform.tpl.html> Pour retourner au formulaire d'inscription cliquer ici. </a>";
                        echo ' <a href=connexionemployeurform.tpl.html> Pour vous connecter cliquer ici. </a>';
				    } 
                    else 
                    {
				        $req=$c->prepare("INSERT INTO Employeurs VALUES (0,?, ?, ?, ?, ?)");
                        $req->execute([$Prenom,$Nom,$Societe,$Email,$Mdp]);
                        echo "Inscription réussie !";
                        echo ' <a href=connexionemployeurform.tpl.html> Pour vous connecter cliquer ici. </a>';
	
                    }
				}
            }
    }
						
?>