<?php

//sollicite les services de la classe pdoDao
require_once ('PdoDao.class.php');

class OuvrageDal {
    /*
     * charge un tableau d'auteurs
     * @param $style : 0 == tableau assoc, 1 == objet
     * @return un objet de la classe PDOStatement
     */

    public static function loadOuvrages($style) {
        // instanciation d'un objet PdoDao
        $cnx = new PdoDao();
        $qry = 'SELECT * FROM v_ouvrages';
        $tab = $cnx->getRows($qry, array(), $style);
        if (is_a($tab, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        // dans le cas où on attend un tableau d'objets
        if ($style == 1) {
            //retourne un tableau d'objets
            $res = array();
            foreach ($tab as $ligne) {
                $unOuvrage = new v_Ouvrage(
                        $ligne->no_ouvrage, $ligne->titre, $ligne->salle, $ligne->rayon, $ligne->code_genre, $ligne->lib_genre, $ligne->acquisition, $ligne->auteur, $ligne->dernier_pret, $ligne->disponibilite
                );
                array_push($res, $unOuvrage); // identique ) $res[] = $unAuteur;
            }
            return $res;
        }
        return $tab;
    }

/**
     * ajoute un genre
     * @param   string  $code : le code du genre à ajouter
     * @param   string  $libelle : le libellé du genre à ajouter
     * @return  le nombre de lignes affectées
     */
    public static function addAuteur($nom, $prenom, $alias, $note) {
        $cnx = new PdoDao();
        $qry = 'INSERT INTO auteur (nom_auteur, prenom_auteur, alias, notes) VALUES (?,?,?,?)';
        $res = $cnx->execSQL($qry, array(// nb de lignes affectées
            $nom,
            $prenom,
            $alias,
            $note
                )
        );
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

/**
     * charge un objet de la classe Ouvrage à partir de son code
     * @param  $id : le code de l'ouvrage
     * @return  un objet de la classe ouvrage
     */
    public static function loadOuvrageByID($id) {
        $cnx = new PdoDao();
        // requête
        $qry = 'SELECT no_ouvrage, titre, salle, rayon, code_genre, date_acquisition FROM ouvrage WHERE no_ouvrage = ?';
        $res = $cnx->getRows($qry, array($id), 1);
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        if (!empty($res)) {
            // le genre existe
            $num = $res[0]->no_ouvrage;
            $titre = $res[0]->titre;
            $salle = $res[0]->salle;
            $rayon = $res[0]->rayon;
            $code = $res[0]->code_genre;
            $date = $res[0]->date_acquisition;
            return new Ouvrage($num, $titre, $salle, $rayon, $code, $date);
        } else {
            return NULL;
        }
    }
    
        /**
     * calcule le nombre d'ouvrages pour un genre
     * @param type $code : le code du genre
     * @return le nombre d'ouvrages du genre
     */
    public static function maxID($style) {
        $cnx = new PdoDao();
        $qry = 'SELECT MAX(id_auteur) FROM auteur';
        $res = $cnx->getRows($qry, array(), $style);
        return $res;
                
        //return $res[0];
    }

    /**
     * calcule le nombre d'ouvrages pour un genre
     * @param type $code : le code du genre
     * @return le nombre d'ouvrages du genre
     */
    public static function countOuvragesGenre($id) {
        $cnx = new PdoDao();
        $qry = 'SELECT COUNT(*) FROM ouvrage WHERE id_auteur = ?';
        $res = $cnx->getValue($qry, array($id));
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }
    
        public static function delAuteur($id) {
        $cnx = new PdoDao();
        $qry = 'DELETE FROM auteur WHERE id_auteur = ?';
        $res = $cnx->execSQL($qry, array($id));
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

    /**
     * supprime un genre
     * @param   int $code : le code du genre à supprimer
     * @return le nombre de lignes affectées
     */
    public static function setAuteur($unAuteur) {
        $cnx = new PdoDao();
        $qry = 'UPDATE auteur SET nom_auteur = ?, prenom_auteur = ?, alias = ?, notes = ? WHERE id_auteur = ?';
        $res = $cnx->execSQL($qry, array(
            $unAuteur->getNom(),
            $unAuteur->getPrenom(),
            $unAuteur->getAlias(),
            $unAuteur->getNote(),
            $unAuteur->getId()
        ));
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }
}

?>
