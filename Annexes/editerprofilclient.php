<?php
    require("connexion.php");

    $c= new PDO($host,$login,$password);
    $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    if(isset($_SESSION['email']))
    {
        $gab = new Template("./");
        $gab->set_filenames(array("body"=>"editionprofilclient.html"));
        $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
        $gab->pparse("body");

        
        if(isset($_POST['valider']))
        {
            
            if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']))
            {
                $Newprenom=$_POST['newprenom']; 
                $modifprenom=$c->prepare("UPDATE Client SET Prenom_client=? WHERE Email_client=?");
                $modifprenom->execute(array($Newprenom, $_SESSION['email']));
                echo "Prénom mis à jour";
            }
            
            if(isset($_POST['newnom']) AND !empty($_POST['newnom']))
            {
                $Newnom=$_POST['newnom']; 
                $modifnom=$c->prepare("UPDATE Client SET Nom_client=? WHERE Email_client=?");
                $modifnom->execute(array($Newnom,$_SESSION['email']));
                echo "Nom mis à jour";
            }
            
            if(isset($_POST['newpwd']) AND !empty($_POST['newpwd']))
            {
                $Newpwd=password_hash($_POST['newpwd'],PASSWORD_DEFAULT);; 
                $modifpwd=$c->prepare("UPDATE Client SET Mdp_client=? WHERE Email_client=?");
                $modifpwd->execute(array($Newpwd,$_SESSION['email']));
                echo "Mot de passe mis à jour";
            } 
            
            if(isset($_POST['adresse']) AND !empty($_POST['adresse']))
            {
                $Adresse=$_POST['adresse']; 
                $addadresse=$c->prepare("UPDATE Client SET Adresse_client=? WHERE Email_client=?");
                $addadresse->execute(array($Adresse,$_SESSION['email']));
                echo "Adresse mis à jour";
            }
            
            if(isset($_POST['cp']) AND !empty($_POST['cp']))
            {
                $CP=$_POST['cp']; 
                $addcp=$c->prepare("UPDATE Client SET CP_client=? WHERE Email_client=?");
                $addcp->execute(array($CP,$_SESSION['email']));
                echo "Code postal mis à jour";
            }
            
            if(isset($_POST['ville']) AND !empty($_POST['ville']))
            {
                $Ville=$_POST['ville']; 
                $addville=$c->prepare("UPDATE Client SET Ville_client=? WHERE Email_client=?");
                $addville->execute(array($Ville,$_SESSION['email']));
                echo "Ville mis à jour";
            }
            
            if(isset($_POST['tel']) AND !empty($_POST['tel']))
            {
                $Tel=$_POST['tel']; 
                $addtel=$c->prepare("UPDATE Client SET Tel_client=? WHERE Email_client=?");
                $addtel->execute(array($Tel,$_SESSION['email']));
                echo "Numéro de téléphone mis à jour";
            }
            
            if(isset($_FILES['cv']) AND !empty($_FILES['cv']['name']))
            {
                $TailleMax=3097152; // pour une taille max de 3 Mo du fichier
                $ExtensionsValides=array('jpg','jpeg','pdf');
                
                if($_FILES['cv']['size'] <= $TailleMax)
                {
                    $ExtensionUpload= strtolower(substr(strrchr($_FILES['cv']['name'],'.'),1)); //avoir l'extension du fichier sans le point en minuscule
                    
                    if(in_array($ExtensionUpload,$ExtensionsValides))
                    {
                        $chemin = "".$_SESSION['email'].".".$ExtensionUpload;
                        $resultat = move_uploaded_file($_FILES['cv']['tmp_name'], $chemin);   
                    
                        if($resultat)
                        {
                            $updatecv = $c->prepare("UPDATE Client SET CV=? WHERE Email_client =?");
                            $updatecv->execute(array($_SESSION['email'].".".$ExtensionUpload,$_SESSION['email']));
                            echo "CV mis à jour";
                        }
                        else
                        {
                            echo "Erreur durant l'importation de votre CV";
                        }
                    }
                    else
                    {
                        echo "Votre CV doit être au format jpg, jpeg ou pdf";
                    }
                }
                else
                {
                    echo "Votre CV ne doit pas dépasser 3Mo";
                }

            }
        }
    }
    else
    {
        $gab = new Template("./");
        $gab->set_filenames(array("body"=>"connexionform.tpl.html"));
        $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
        $gab->pparse("body");
    }
    


?>