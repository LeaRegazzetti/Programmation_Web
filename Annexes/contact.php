<?php

if(isset($_POST['mailform']))
{
	if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['prenom']) AND !empty($_POST['message']))
	{
	    $nom=$_POST['nom'];
	    $prenom=$_POST['prenom'];
	    $email=$_POST['mail'];
	    $mes=$_POST['message'];
	    
		$header.='Content-Type:text/html; charset="uft-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';

		$message= "Nom:\t$nom\n";
		$message.= "Prénom:\t$prenom\n";
		$message .= "E-Mail:\t$email\n";
        $message .= "Message:\t$mes\n\n";

		mail("learegazzetti@hotmail.fr", "Contact JOBSEARCH", $message, $header);
		$msg="Le message a bien été transmis, nous allons vous répondre dans les plus brefs délais ";
	}
	else
	{
		$msg="L'intégralité des champs doit être complétée !";
	}
}
if(isset($msg))
	{
		echo $msg;
		echo ' <a href=index.php> Pour revenir à l\'accueil cliquer ici. </a>';
	}
?>
