<?php

require_once 'modele/OuvrageDal.class.php';
require_once 'include/_reference.lib.php';

if (!(isset($_REQUEST['action']))) {
    $action = 'listerOuvrages';
} else {
    $action = $_REQUEST['action'];
}

// variables pour al gestion des messages
$msg = '';      // message passé à la vue v_afficherMessage
$lien = '';     // message passé à la vue v_afficherErreurs
// variables pour la gestion des messages
$titrePage = 'Gestion des ourvages';
// variables pour la gestion des erreurs
$tabErreurs = array();
$hasErrors = false;
// initialisation des variables
$strNum = '';
$strtitre = '';
$strlib_genre = '';
$strauteur = '';
$strsalle = '';
$strrayon = '';
$strdernier_pret = '';
$strdisponibilite = '';

switch ($action) {
    case'listerOuvrages' : {
            // récupérer les auteurs
            $lesOuvrages = OuvrageDal::loadOuvrages(1);
            // afficher le nombre d'auteurs
            $nbOuvrages = count($lesOuvrages);
            include ('vues/v_listerOuvrages.php');
        }
        break;

    case'ajouterOuvrage' : {
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

    case'consulterOuvrage' : {
            // récupération du code
            if (isset($_GET["id"])) {
                $id = htmlentities($_GET["id"]);
                // appel de la méthode du modèle
                $leOuvrage = OuvrageDal::loadOuvrageByID($id);
                if ($leOuvrage == NULL) {
                    $tabErreurs[] = 'Cette ouvrage n\'existe pas !';
                    $hasErrors = true;
                }
            } else {
                //pas d'id dans l'url ni clic sur Valider : c'est anormal
                $tabErreurs[] = "Aucun ouvrage n'a été transmis pour consultation !";
                $hasErrors = true;
            }

            if ($hasErrors) {
                include 'vues/_v_afficherErreurs.php';
            } else {
                include 'vues/v_consulterOuvrage.php';
            }
        }
        break;

    case'supprimerAuteur' : {
            // récupération du code
            if (isset($_GET["id"])) {
                $id = strtoupper(htmlentities($_GET["id"]));
                // appel de la méthode du modèle
                $leAuteur = AuteurDal::loadAuteurByID($id);
                if ($leAuteur == NULL) {
                    $tabErreurs[] = 'Cet auteur n\'existe pas !';
                    $hasErrors = true;
                } else {
                    // rechercher des ouvrages de ce genre
                    if (AuteurDal::countOuvragesGenre($leAuteur->getId()) > 0) {
                        // il y a des ouvrages référencés, suppression impossible
                        $tabErreurs[] = 'Il existe des auteurs qui références cet ouvrage, suppression impossible !';
                        $hasErrors = true;
                    }
                }
            } else {
                //pas d'id dans l'url ni clic sur Valider : c'est anormal
                $tabErreurs[] = "Aucun Auteur n'a été transmis pour consultation !";
                $hasErrors = true;
            }

            if (!$hasErrors) {
                $res = AuteurDal::delAuteur($leAuteur->getId());
                if ($res > 0) {
                    $msg = 'Le auteur' . $leAuteur->getId() . 'a été supprimé';
                    include 'vues/_v_afficherMessage.php';
                    $lesAuteurs = AuteurDal::loadAuteurs(1);
                    // afficher le nombre d'auteurs
                    $nbAuteur = count($lesAuteurs);
                    include ('vues/v_listerAuteurs.php');
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

    case'modifierAuteur' : {
            // initialisation des variables
            $tabErreurs = array();
            $hasErrors = false;
            // initialisation des variables
            $strNom = '';
            $strPrenom = '';
            $strAlias = '';
            $strNotes = '';
            // créer l'objet genre
            if (isset($_REQUEST["id"])) {
                $intID = strtoupper(htmlentities($_REQUEST["id"]));
                $leAuteur = AuteurDal::loadAuteurByID($intID);
                if ($leAuteur == NULL) {
                    $tabErreurs[] = 'Cet auteur n\'existe pas !';
                    $hasErrors = true;
                }
            } else {
                //pas d'id dans l'url ni clic sur Valider : c'est anormal
                $tabErreurs[] = "Aucun aucun n'a été transmis pour validation !";
                $hasErrors = true;
            }
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'saisirAuteur';
            }
            switch ($option) {
                case 'saisirAuteur' : {
                        if (!$hasErrors) {
                            // affichage de la vue de modification
                            // l'objet Genre $leGenre est connu
                            include('vues/v_modifierAuteur.php');
                        } else {
                            $msg = "L'opération de modification n'a pas pu être menée à bien";
                            include('vues/_v_afficherErreurs.php');
                        }
                    } break;
                case 'validerAuteur' : {
                        if (!$hasErrors) {
                            if (isset($_POST["cmdValider"])) {
                                // récupération du libellé
                                if (!empty($_POST["txtNom"])) {
                                    $strNom = ucfirst(htmlentities($_POST["txtNom"]));
                                } else {
                                    $tabErreurs[] = "Le nom doit être renseigné !";
                                    $hasErrors = true;
                                }
                                $strPrenom = ucfirst(htmlentities($_POST["txtPrenom"]));
                                $strAlias = ucfirst(htmlentities($_POST["txtAlias"]));
                                $strNotes = ucfirst(htmlentities($_POST["txtNotes"]));
                                if (!$hasErrors) {
                                    $leAuteur->setNom($strNom);
                                    $leAuteur->setPrenom($strPrenom);
                                    $leAuteur->setAlias($strAlias);
                                    $leAuteur->setNote($strNotes);
                                    $res = AuteurDal::setAuteur($leAuteur);
                                    if ($res > 0) {
                                        $msg = 'L\'auteur '
                                                . $leAuteur->getId() . ' - '
                                                . $leAuteur->getNom() . ' a été modifié';
                                        include ("vues/_v_afficherMessage.php");
                                        include 'vues/v_consulterAuteur.php';
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