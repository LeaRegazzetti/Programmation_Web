<?php
    
    session_start(); 
    
    include ("connect.inc.php");
    include("entete.inc.html");
    require("projetmodele.class.php");
    require("projetcontroleur.class.php");

    
    

    if(isset($_POST['connexion'])) 
    { 
        if(empty($_POST['email'])) 
        {
            echo "Le champ Email est vide.";
            $gab = new Template("./");
            $gab->set_filenames(array("body"=>"connexionemployeurform.tpl.html"));
            $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
            $gab->pparse("body");
        } 
        else 
        {
            if(empty($_POST['pwd'])) 
            {
                echo "Le champ Mot de passe est vide.";
                $gab = new Template("./");
                $gab->set_filenames(array("body"=>"connexionemployeurform.tpl.html"));
                $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
                $gab->pparse("body");
            } 
            else 
            {
                $c= new PDO($host,$login,$password);
                $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                
                if(!$c)
                {
                    echo "Erreur de connexion à la base de données.";
                } 
                else 
                {
                    $Email = $_POST['email'];
                    $MotDePasse = $_POST['pwd'];
                
                    $res =$c->prepare("SELECT id, Mdp_emp FROM Employeurs WHERE Email_emp = '".$Email."'");
                    $res->execute();
                    $resultat=$res->fetch();
                    
                    $isPasswordCorrect = password_verify($_POST['pwd'], $resultat['Mdp_emp']);
                    
                    
                    if($isPasswordCorrect)
                    {
                        $_SESSION['email'] = $Email;
                        $acc=new AccesEmp($c,$Email);
                        $appli=new Appli($acc);
                        $appli->moteur($acc);
                        
                    }
                    else
                    { 
                        echo "Le pseudo ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
                        $gab = new Template("./");
                        $gab->set_filenames(array("body"=>"connexionemployeurform.tpl.html"));
                        $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
                        $gab->pparse("body"); 
                    }
                   
                }
            }
        }
    }
?>