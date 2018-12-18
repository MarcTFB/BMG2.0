<?php
/**
 *
 * BMG
 * © GroSoft
 *
 * References
 * Classes métier
 *
 *
 * @package 	default
 * @author 	dk
 * @version    	1.0
 */

/*
 *  ====================================================================
 *  Classe Genre : représente un genre d'ouvrage
 *  ====================================================================
*/

class Genre {
    private $_code;
    private $_libelle;

    /**
     * Constructeur
    */
    public function __construct(
            $p_code,
            $p_libelle
    ) {
        $this->setCode($p_code);
        $this->setLibelle($p_libelle);
    }

    /**
     * Accesseurs
    */
    public function getCode () {
        return $this->_code;
    }

    public function getLibelle () {
        return $this->_libelle;
    }

    /**
     * Mutateurs
    */
    public function setCode ($p_code) {
        $this->_code = $p_code;
    }

    public function setLibelle ($p_libelle) {
        $this->_libelle = $p_libelle;
    }

}



class Auteur {
    private $_id;
    private $_nom;
    private $_prenom;
    private $_alias;
    private $_notes;
    /**
     * Constructeur
    */
    public function __construct(
            $p_id,
            $p_nom,
            $p_prenom,
            $p_alias,
            $p_notes
    ) {
        $this->setId($p_id);
        $this->setNom($p_nom);
        $this->setPrenom($p_prenom);
        $this->setAlias($p_alias);
        $this->setNotes($p_notes);
    }

    /**
     * Accesseurs
    */
    public function getId () {
        return $this->_id;
    }

    public function getNom () {
        return $this->_nom;
    }

    public function getPrenom () {
        return $this->_prenom;
    }

    public function getAlias () {
        return $this->_alias;
    }

    public function getNotes () {
        return $this->_notes;
    }

    /**
     * Mutateurs
    */
    public function setId ($p_id) {
        $this->_id = $p_id;
    }

    public function setNom ($p_nom) {
        $this->_nom = $p_nom;
    }

    public function setPrenom ($p_prenom) {
        $this->_prenom = $p_prenom;
    }

    public function setAlias ($p_alias) {
        $this->_alias = $p_alias;
    }

      public function setNotes ($p_notes) {
        $this->_notes = $p_notes;
    }

}

/*
 *  ====================================================================
 *  Classe Ouvrage : représente un genre d'ouvrage 
 *  ====================================================================
*/

class v_Ouvrage {
    private $num;
    private $titre;
    private $salle;
    private $rayon;
    private $code_genre;
    private $lib_genre;
    private $acquisition;
    private $auteur;
    private $dernier_pret;
    private $disponibilite;

    /**
     * Constructeur 
    */                                
    public function __construct(
            $p_num,
            $p_titre,
            $p_salle,
            $p_rayon,
            $p_code_genre,
            $p_lib_genre,
            $p_acquisition,
            $p_auteur,
            $p_dernier_pret,
            $p_disponibilite
    ) {
        $this->setNum($p_num);
        $this->setTitre($p_titre);
        $this->setSalle($p_salle);
        $this->setRayon($p_rayon);
        $this->setCode_genre($p_code_genre);
        $this->setLib_genre($p_lib_genre);
        $this->setAcquisition($p_acquisition);
        $this->setAuteur($p_auteur);
        $this->setDernier_pret($p_dernier_pret);
        $this->setDisponibilite($p_disponibilite);
    }  
    
    /**
     * Accesseurs
    */
    public function getNum () {
        return $this->_Num;
    }

    public function getTitre () {
        return $this->_Titre;
    }
    
    public function getSalle () {
        return $this->_Salle;
    }

    public function getRayon () {
        return $this->_Rayon;
    }
    
    public function getCode_genre () {
        return $this->_Code_genre;
    }
    public function getLib_genre () {
        return $this->_Lib_genre;
    }

    public function getAcquisition () {
        return $this->_Acquisition;
    }
    
    public function getAuteur () {
        return $this->_Auteur;
    }

    public function getDernier_pret () {
        return $this->_Dernier_pret;
    }
    
    public function getDisponibilite () {
        return $this->_Disponibilite;
    }
    
    
    /**
     * Mutateurs
    */   
    public function setNum ($p_num) {
        $this->_Num = $p_num;
    }

    public function setTitre ($p_titre) {
        $this->_Titre = $p_titre;
    }
    
    public function setSalle ($p_salle) {
        $this->_Salle = $p_salle;
    }

    public function setRayon ($p_rayon) {
        $this->_Rayon = $p_rayon;
    }
    
    public function setCode_genre ($p_code_genre) {
        $this->_Code_genre = $p_code_genre;
    }
    public function setLib_genre ($p_lib_genre) {
        $this->_Lib_genre = $p_lib_genre;
    }

    public function setAcquisition ($p_acquisition) {
        $this->_Acquisition = $p_acquisition;
    }
    
    public function setAuteur ($p_auteur) {
        $this->_Auteur = $p_auteur;
    }

    public function setDernier_pret ($p_dernier_pret) {
        $this->_Dernier_pret = $p_dernier_pret;
    }
    
    public function setDisponibilite ($p_disponibilite) {
        $this->_Disponibilite = $p_disponibilite;
    }
}

/*
 *  ====================================================================
 *  Classe Ouvrage : représente un genre d'ouvrage 
 *  ====================================================================
*/

class Ouvrage {
    private $num;
    private $titre;
    private $salle;
    private $rayon;
    private $code_genre;
    private $acquisition;

    /**
     * Constructeur 
    */                                
    public function __construct(
            $p_num,
            $p_titre,
            $p_salle,
            $p_rayon,
            $p_code_genre,
            $p_acquisition
    ) {
        $this->setNum($p_num);
        $this->setTitre($p_titre);
        $this->setSalle($p_salle);
        $this->setRayon($p_rayon);
        $this->setCode_genre($p_code_genre);
        $this->setAcquisition($p_acquisition);
    }  
    
    /**
     * Accesseurs
    */
    public function getNum () {
        return $this->_Num;
    }

    public function getTitre () {
        return $this->_Titre;
    }
    
    public function getSalle () {
        return $this->_Salle;
    }

    public function getRayon () {
        return $this->_Rayon;
    }
    
    public function getCode_genre () {
        return $this->_Code_genre;
    }

    public function getAcquisition () {
        return $this->_Acquisition;
    }
    
    
    /**
     * Mutateurs
    */   
    public function setNum ($p_num) {
        $this->_Num = $p_num;
    }

    public function setTitre ($p_titre) {
        $this->_Titre = $p_titre;
    }
    
    public function setSalle ($p_salle) {
        $this->_Salle = $p_salle;
    }

    public function setRayon ($p_rayon) {
        $this->_Rayon = $p_rayon;
    }
    
    public function setCode_genre ($p_code_genre) {
        $this->_Code_genre = $p_code_genre;
    }

    public function setAcquisition ($p_acquisition) {
        $this->_Acquisition = $p_acquisition;
    }
}