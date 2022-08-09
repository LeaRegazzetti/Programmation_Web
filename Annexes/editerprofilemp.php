<?php
    session_start();
    require("connexionemployeur.php");
    

    $c= new PDO($host,$login,$password);
    $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    if(isset($_SESSION['email']))
    {
        $gab = new Template("./");
        $gab->set_filenames(array("body"=>"editionprofilemp.html"));
        $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
        $gab->pparse("body");

        
        if(isset($_POST['valider']))
        {
            if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']))
            {
                $Newprenom=$_POST['newprenom']; 
                $modifprenom=$c->prepare("UPDATE Employeurs SET Prenom_emp=? WHERE Email_emp=?");
                $modifprenom->execute(array($Newprenom, $_SESSION['email']));
            }
            
            if(isset($_POST['newnom']) AND !empty($_POST['newnom']))
            {
                $Newnom=$_POST['newnom']; 
                $modifnom=$c->prepare("UPDATE Employeurs SET Nom_emp=? WHERE Email_emp=?");
                $modifnom->execute(array($Newnom,$_SESSION['email']));
            }
            
            if(isset($_POST['newsociete']) AND !empty($_POST['newsociete']))
            {
                $Newsociete=$_POST['newsociete']; 
                $modifsociete=$c->prepare("UPDATE Employeurs SET Societe=? WHERE Email_emp=?");
                $modifsociete->execute(array($Newsociete,$_SESSION['email']));
            }
            
            if(isset($_POST['newpwd']) AND !empty($_POST['newpwd']))
            {
                $Newpwd=password_hash($_POST['newpwd'],PASSWORD_DEFAULT);; 
                $modifpwd=$c->prepare("UPDATE Employeurs SET Mdp_emp=? WHERE Email_emp=?");
                $modifpwd->execute(array($Newpwd,$_SESSION['email']));
            } 
            $msg="Informations mises à jour";
            echo $msg;
        }
    }
    else
    {
        $gab = new Template("./");
        $gab->set_filenames(array("body"=>"connexionemployeurform.tpl.html"));
        $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
        $gab->pparse("body");
    }
    


?>