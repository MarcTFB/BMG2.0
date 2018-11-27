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

    /**
     * Constructeur
    */
    public function __construct(
            $p_id,
            $p_nom
    ) {
        $this->setId($p_id);
        $this->setNom($p_nom);
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

    /**
     * Mutateurs
    */
    public function setId ($p_id) {
        $this->_id = $p_id;
    }

    public function setNom ($p_nom) {
        $this->_nom = $p_nom;
    }

}
