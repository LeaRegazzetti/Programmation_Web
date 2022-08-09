<?php

    require("projet.class.php");
    
    class Requeteannonce extends Requete
    {
        
     public function afficherTabAnnonce()
        {
            $gab=new Template("./");
            $gab->set_filenames(array("body" => "annoncetab.tpl.html"));
            $gab->assign_vars(array("nom" => $this->nom));
            foreach($this->data as $ligne)
            {
                $gab->assign_block_vars("ligne",array("Rien" => ""));
                foreach($ligne as $val)
                    $gab->assign_block_vars("ligne.attribut",array("valeur" => $val));
            }
            $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
            $gab->pparse("body");
        }   
    }
    class Requeteclient extends Requete
    {
        
     public function afficherTabClient()
        {
            $gab=new Template("./");
            $gab->set_filenames(array("body" => "clienttab.tpl.html"));
            $gab->assign_vars(array("nom" => $this->nom));
            foreach($this->data as $ligne)
            {
                $gab->assign_block_vars("ligne",array("Prenom_client" => $ligne["Prenom_client"]));
                foreach($ligne as $val)
                    $gab->assign_block_vars("ligne.attribut",array("valeur" => $val));
            }
            $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
            $gab->pparse("body");
        }   
    }

    class Requeteemployeur extends Requete
    {
        
     public function afficherTabEmployeur()
        {
            $gab=new Template("./");
            $gab->set_filenames(array("body" => "employeurtab.tpl.html"));
            $gab->assign_vars(array("nom" => $this->nom));
            foreach($this->data as $ligne)
            {
                $gab->assign_block_vars("ligne",array("Prenom_emp" => $ligne["Prenom_emp"]));
                foreach($ligne as $val)
                    $gab->assign_block_vars("ligne.attribut",array("valeur" => $val));
            }
            $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
            $gab->pparse("body");
        }   
    }

    class Requetemesannonces extends Requete
    {
        
     public function afficherTabMesAnnonces()
        {
            $gab=new Template("./");
            $gab->set_filenames(array("body" => "mesannoncestab.tpl.html"));
            $gab->assign_vars(array("nom" => $this->nom));
            foreach($this->data as $ligne)
            {
                $gab->assign_block_vars("ligne",array("ID_annonce" => $ligne["ID_annonce"]));
                foreach($ligne as $val)
                    $gab->assign_block_vars("ligne.attribut",array("valeur" => $val));
            }
            $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
            $gab->pparse("body");
        }   
    }
    
    class Requeteannoncemail extends Requete
    {
        
     public function afficherTabAnnonceMail()
        {
            $gab=new Template("./");
            $gab->set_filenames(array("body" => "annoncemailtab.tpl.html"));
            $gab->assign_vars(array("nom" => $this->nom));
            foreach($this->data as $ligne)
            {
                $gab->assign_block_vars("ligne",array("Rien" => ""));
                foreach($ligne as $val)
                    $gab->assign_block_vars("ligne.attribut",array("valeur" => $val));
            }
            $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"]));
            $gab->pparse("body");
        }   
    }
    
    class AccesMesAnnonces
    {
        private $pdo;
        private $qmat;
        
        
        function __construct($param_pdo,$Email)
         { 
            $this->pdo = $param_pdo;
            $this->qmat = new Requetemesannonces($this->pdo," ","SELECT Titre, Type_emploi, Localisation, Descriptif FROM Annonces WHERE Annonces.Email_employeur='".$Email."'");
         }
        
        public function liste()
        {
            $this->qmat->executer();
            $this->qmat->afficherTabMesAnnonces();
        }
        
        public function supprimerAnnonce($ID_annonce)
        {
            $res=$this->pdo->prepare("DELETE FROM Annonces WHERE ID_annonce = ?");
            $res->execute([$ID_annonce]);
        }
    }
    class AccesAnnonces
    {
        private $pdo;
        private $qmat;
        
        
        function __construct($param_pdo)
         { 
            $this->pdo = $param_pdo;
            $this->qmat = new Requeteannonce($this->pdo," ","SELECT Titre, Type_emploi, Localisation, Descriptif FROM Annonces");
         }
        
        public function liste()
        {
            $this->qmat->executer();
            $this->qmat->afficherTabAnnonce();
        }
        
    }
        
    class AccesClient
    {
        private $pdo;
        private $qmat;
        
        
        function __construct($param_pdo,$Email)
         { 
            $this->pdo = $param_pdo;
            $this->qmat = new Requeteclient($this->pdo,"","SELECT Prenom_client, Nom_client, Email_client, Adresse_client, CP_client, Ville_client, Tel_client, CV FROM Client WHERE Email_client='".$Email."'");
            
         }
        
        public function liste()
        {
            $this->qmat->executer();
            $this->qmat->afficherTabClient();
        }
    }
    
    class AccesEmp
    {
        private $pdo;
        private $qmat;
        
        function __construct($param_pdo,$Email)
         { 
            $this->pdo = $param_pdo;
            $this->qmat = new Requeteemployeur($this->pdo," ","SELECT Prenom_emp, Nom_emp, Societe FROM Employeurs WHERE Email_emp='".$Email."'");
            
         }
        
        public function liste()
        {
            $this->qmat->executer();
            $this->qmat->afficherTabEmployeur();
        }
    }
     
    class AccesAnnoncesMail
    {
        private $pdo;
        private $qmat;
        
        
        function __construct($param_pdo)
         { 
            $this->pdo = $param_pdo;
            $this->qmat = new Requeteannoncemail($this->pdo," ","SELECT Titre, Type_emploi, Localisation, Descriptif, Email_employeur FROM Annonces");
         }
        
        public function liste()
        {
            $this->qmat->executer();
            $this->qmat->afficherTabAnnonceMail();
        }
        
    }   
?>