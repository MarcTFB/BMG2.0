<?php

if(!isset($_REQUEST["action"])){
    $action = "listerGenres";
}
else{
    $acion = $_REQUEST["action"];
}
// variables pour la gestion des messages
$msg = ''; // message passé ç la vue _v_afficherMessage
$lien = ''; // message passé ç la vue _v_afficherErreurs

switch($action){
    case 'listerGenres' : {
            
    }
    break;

    case 'ajouterGenres' : {
            
    }
    break;

    case 'modifierGenres' : {
            
    }
    break;

    case 'supprimerGenres' : {
            
    }
    break;

    default : include 'include/vues/_v_home.php';
}

