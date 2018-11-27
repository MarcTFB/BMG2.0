<?php
require_once 'modele/AuteurDal.class.php';
require_once 'include/_reference.lib.php';

if(!isset($_REQUEST["action"])){
    $action = "listerAuteurs";
}
else{
    $action = $_REQUEST["action"];
}

$titrePage = 'Gestion des auteurs';

$tabErreurs = array();
$hasErrors = false;

// variables pour la gestion des messages
$msg=''; //msg passé à v_afficherMessages
$lien=''; //msg passé à v_afficherErreurs


// initialisation des variables
$id = 0;
$strNom = '';
$strPrenom = '';
$strAlias = '' ;
$strNotes = '' ;

switch($action){
    case 'listerAuteurs' : {
        $lesAuteurs = AuteurDal::loadAuteurs(1);
        $nbAuteurs = count($lesAuteurs);
        include("vues/v_listerAuteurs.php");
    }
    break;

    case 'consulterAuteur' : {

    }
    break;

    case 'ajouterAuteur' : {

    }
    break;

    case 'saisirAuteur' : {

    }
    break;

    case 'modifierAuteur' : {

    }
    break;

    case 'supprimerAuteur' : {

    }
    break;
}
