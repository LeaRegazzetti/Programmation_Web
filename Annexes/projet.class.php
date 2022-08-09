<?php

    // Appel au template
    require("template.class.php");   

    class Requete
    {
        protected $pdo;
        protected $nom;
        protected $req;
        protected $data;
        
        function __construct($pdo_param,$nom_param,$req_param)
         { 
            $this->pdo = $pdo_param;
            $this->nom = $nom_param;
            $this->req = $req_param;
         }
        
        public function executer()
        {
            $res=$this->pdo->prepare($this->req);
            $res->execute();
            $this->data=$res->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function afficherTab()
        {
            $gab=new Template("./");
            $gab->set_filenames(array("body"=>"projet.tpl.html"));
            $gab->assign_vars(array("nom" => $this->nom));
            foreach($this->data as $ligne)
            {
                $gab->assign_block_vars("ligne",array("rien" => ""));
                foreach($ligne as $val)
                    $gab->assign_block_vars("ligne.attribut",array("valeur"=>$val));
            }
            $gab->pparse("body");
        }
    }


?>
