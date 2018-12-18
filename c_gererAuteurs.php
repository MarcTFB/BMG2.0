<?php

require_once 'modele/AuteurDal.class.php';
require_once 'include/_reference.lib.php';

if (!(isset($_REQUEST['action']))) {
    $action = 'listerAuteur';
} else {
    $action = $_REQUEST['action'];
}

// variables pour al gestion des messages
$msg = '';      // message passé à la vue v_afficherMessage
$lien = '';     // message passé à la vue v_afficherErreurs
// variables pour la gestion des messages
$titrePage = 'Gestion des auteurs';
// variables pour la gestion des erreurs
$tabErreurs = array();
$hasErrors = false;
// initialisation des variables
$strCode = '';
$strLibelle = '';
$id = '';

switch ($action) {
    case'listerAuteur' : {
            // récupérer les auteurs
            $lesAuteurs = AuteurDal::loadAuteurs(1);
            // afficher le nombre d'auteurs
            $nbAuteur = count($lesAuteurs);
            include ('vues/v_listerAuteurs.php');
        }
        break;

    case'ajouterAuteur' : {
            // traitement de l'option : saisie ou validation ?
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'saisirAuteur';
            }
            switch ($option) {
                case 'saisirAuteur' : {
                        include 'vues/v_ajouterAuteur.php';
                    } break;
                case 'validerAuteur' : {
                        if (isset($_POST["cmdValider"])) {
                            // récupération du libellé
                            
                            if (!empty($_POST["txtNom"])) {
                                $strNom = ucfirst(htmlentities($_POST["txtNom"]));
                            }
                            if (!empty($_POST["txtPrenom"])) {
                                $strPrenom = strtoupper(htmlentities($_POST["txtPrenom"]));
                            }
                            if (!empty($_POST["txtAlias"])) {
                                $strAlias = strtoupper(htmlentities($_POST["txtAlias"]));
                            }
                            if (!empty($_POST["txtNotes"])) {
                                $strNotes = strtoupper(htmlentities($_POST["txtNotes"]));
                            }
                            // test zones obligatoires
                            if (empty($strNom)) {
                                $tabErreurs[] = "Le nom doit être renseigné !";
                                $hasErrors = true;
                            }
                            if (!$hasErrors) {
                                $res = AuteurDal::addAuteur($strNom, $strPrenom, $strAlias, $strNotes);
                                if ($res > 0) {
                                    $msg = 'Le auteur '
                                            . $strNom . ' - '
                                            . $strPrenom . ' a été ajouté';
                                    $leAuteur = new Auteur($id, $strNom, $strPrenom, $strAlias, $strNotes);
                                    //$leGenre = GenreDal::loadGenreByID($strCode);
                                    include ("vues/_v_afficherMessage.php");
                                } else {
                                    $tabErreurs["Erreur"] = 'Une erreur s\'est produite dans l\'opération d\'ajout !';
                                    $hasErrors = true;
                                }
                            }
                            if ($hasErrors) {
                                $msg = "L'opération d'ajout n'a pas pu être menée à terme en raison des erreurs suivantes :";
                                $lien = '<a href="index.php?uc=gererGenres&action=ajouterGenre">Retour à la saisie</a>';
                                include ('vues/_v_afficherErreurs.php');
                            }
                        }
                    }
                    break;
            }
        }
        break;

     case'consulterAuteur' : {
            // récupération du code
            if (isset($_GET["id"])) {
                $id = htmlentities($_GET["id"]);
                // appel de la méthode du modèle
                $leAuteur = AuteurDal::loadAuteurByID($id);
                if ($leAuteur == NULL) {
                    $tabErreurs[] = 'Cette auteur n\'existe pas !';
                    $hasErrors = true;
                }
            } else {
                //pas d'id dans l'url ni clic sur Valider : c'est anormal
                $tabErreurs[] = "Aucun auteur n'a été transmis pour consultation !";
                $hasErrors = true;
            }

            if ($hasErrors) {
                include 'vues/_v_afficherErreurs.php';
            } else {
                include 'vues/v_consulterAuteur.php';
            }
        }
        break;

    case'supprimerGenre' : {
            // récupération du code
            if (isset($_GET["id"])) {
                $strCode = strtoupper(htmlentities($_GET["id"]));
                // appel de la méthode du modèle
                $leGenre = GenreDal::loadGenreByID($strCode);
                if ($leGenre == NULL) {
                    $tabErreurs[] = 'Ce genre n\'existe pas !';
                    $hasErrors = true;
                } else {
                    // rechercher des ouvrages de ce genre
                    if (GenreDal::countOuvragesGenre($leGenre->getCode()) > 0) {
                        // il y a des ouvrages référencés, suppression impossible
                        $tabErreurs[] = 'Il existe des ouvrages qui références ce genre, suppression impossible !';
                        $hasErrors = true;
                    }
                }
            } else {
                //pas d'id dans l'url ni clic sur Valider : c'est anormal
                $tabErreurs[] = "Aucun genre n'a été transmis pour consultation !";
                $hasErrors = true;
            }

            if (!$hasErrors) {
                $res = GenreDal::delGenre($leGenre->getCode());
                if ($res > 0) {
                    $msg = 'Le genre' . $leGenre->getCode() . 'a été supprimé';
                    include 'vues/_v_afficherMessage.php';
                    $lesGenres = GenreDal::loadGenres(1);
                    $nbGenres = count($lesGenres);
                    include 'vues/v_listerGenres.php';
                } else {
                    $tabErreurs[] = "Une erreur s\'est produite dans l\'opération de suppression";
                    $hasErrors = true;
                }
            }

            if ($hasErrors) {
                $msg = "L'opération de suppréssion n'a pas pu être menée à terme en raison des erreurs suivantes :";
                $lien = '<a href="index.php?uc=gererGenres">Retour à la saisie</a>';
                include 'vues/_v_afficherErreurs.php';
            }
        }
        break;

    case'modifierGenre' : {
            // initialisation des variables
            $tabErreurs = array();
            $hasErrors = false;
            $strLibelle = "";
            // créer l'objet genre
            if (isset($_REQUEST["id"])) {
                $strCode = strtoupper(htmlentities($_REQUEST["id"]));
                $leGenre = GenreDal::loadGenreByID($strCode);
                if ($leGenre == NULL) {
                    $tabErreurs[] = 'Ce genre n\'existe pas !';
                    $hasErrors = true;
                }
            } else {
                //pas d'id dans l'url ni clic sur Valider : c'est anormal
                $tabErreurs[] = "Aucun genre n'a été transmis pour validation !";
                $hasErrors = true;
            }
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'saisirGenre';
            }
            switch ($option) {
                case 'saisirGenre' : {
                        if (!$hasErrors) {
                            // affichage de la vue de modification
                            // l'objet Genre $leGenre est connu
                            include('vues/v_modifierGenre.php');
                        } else {
                            $msg = "L'opération de modification n'a pas pu être menée à bien";
                            include('vues/_v_afficherErreurs.php');
                        }
                    } break;
                case 'validerGenre' : {
                        if (!$hasErrors) {
                            if (isset($_POST["cmdValider"])) {
                                // récupération du libellé
                                if (!empty($_POST["txtLibelle"])) {
                                    $strLibelle = ucfirst(htmlentities($_POST["txtLibelle"]));
                                } else {
                                    $tabErreurs[] = "Le libellé doit être renseigné !";
                                    $hasErrors = true;
                                }
                                if (!$hasErrors) {
                                    $leGenre->setLibelle($strLibelle);
                                    $res = GenreDal::setGenre($leGenre);
                                    if ($res > 0) {
                                        $msg = 'Le genre '
                                                . $leGenre->getCode() . ' - '
                                                . $leGenre->getLibelle() . ' a été modifié';
                                        include ("vues/_v_afficherMessage.php");
                                        include 'vues/v_consulterGenre.php';
                                    } else {
                                        $tabErreurs[] = 'Une erreur s\'est produite dans l\'opération de modification !';
                                        $hasErrors = true;
                                    }
                                }
                            }
                        }if ($hasErrors) {
                            $msg = "L'opération de modification n'a pas pu être menée à terme en raison des erreurs suivantes :";
                            include ('vues/_v_afficherErreurs.php');
                        }
                    }
                    break;
            }
        }
        break;



    default : include 'vues/_v_home.php';
}
?> 