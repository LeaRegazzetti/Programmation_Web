<?php

    class Appli
    {
        private function formulaire($suivant)
        {
            $gab=new Template("./");
            $gab->set_filenames(array("body"=>"annonceform.tpl.html"));
            $gab->assign_vars(array("cible" => $_SERVER["PHP_SELF"],
                                   "suivant" => $suivant));
            $gab->pparse("body");
        }
        
        private function formulaireco($suivant)
        {
    
            $gab = new Template("./");
            $gab->set_filenames(array("body"=>"connexionform.tpl.html"));
            $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"],
                                   "suivant" => $suivant));
            $gab->pparse("body");

        }
        private function formulaireins($suivant)
        {
    
            $gab = new Template("./");
            $gab->set_filenames(array("body"=>"inscriptionform.tpl.html"));
            $gab->assign_vars(array("cible"=>$_SERVER["PHP_SELF"],
                                   "suivant" => $suivant));
            $gab->pparse("body");

        }
        
        public function moteur($acc)
        {
            if (isset($_GET["suivant"]))
                $action=$_GET["suivant"];
            else
                $action = "";
            
          switch($action)  
          {
                  
              case "suppr":
                  $acc->supprimerAnnonce($_GET["ID_annonce"]);
                  $acc->liste();
                  break;
                  
               case "connexion":
                    $this->formulaireco("connexion_client");
                    break;
                  
              case "inscription":
                    $this->formulaireins("inscription_client");
                    break;
                  
              case "valider":
                  $this->formulaire("nouvelle_annonce");
                  break;
                  
                default:
                    $acc->liste();
            }
        }
    }
?>