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
 * @package         default
 * @author         dk
 * @version            1.0
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

/*
 *  ====================================================================
 *  Classe Genre : représente un genre d'ouvrage 
 *  ====================================================================
*/

class Auteur {
    private $id;
    private $nom;
    private $prenom;
    private $alias;
    private $note;

    /**
     * Constructeur 
    */                                
    public function __construct(
            $p_id,
            $p_nom,
            $p_prenom,
            $p_alias,
            $p_note
    ) {
        $this->setId($p_id);
        $this->setNom($p_nom);
        $this->setPrenom($p_prenom);
        $this->setAlias($p_alias);
        $this->setNote($p_note);
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
    
    public function getNote () {
        return $this->_note;
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
    
    public function setNote ($p_note) {
        $this->_note = $p_note;
    }

}

