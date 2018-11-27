<?php
// sollicite services de la classe PdoDal
require_once ('PdoDao.class.php');

class AuteurDal {

/*
 * charge un tableau
 * @param $style : 0 == tableau assoc, 1 == objet
 * @return un objet de la classe PDOStatement
 */

    public static function loadAuteurs($style){
        // instanciation d'un objet PdoDao
        $cnx = new PdoDao();
        $qry = "SELECT * FROM v_auteurs";
        $tab = $cnx->getRows($qry, array(), $style);
        if (is_a($tab,'PDOException')){
            return PDO_EXCEPTION_VALUE;
        }

        // dans le cas où on attend un tableau d'objets
        if ($style == 1){
            // retourner un tableau d'objets
            $res = array();
            foreach($tab as $ligne){
                $unAuteur = new Auteur(
                    $ligne->id_auteur,
                    $ligne->nom
                    );
                array_push($res, $unAuteur); // identique à res[] = $unAuteur
            }
            return $res;
        }
        return $tab;
    }

    /**
     * charge un objet de la classe Auteur à partir de son code
     * @param  $id : le code du genre
     * @return  un objet de la classe Genre
     */
    public static function loadAuteurByID($id) {
        $cnx = new PdoDao();
        // requête
        $qry = 'SELECT id_auteur, nom_auteur FROM auteur WHERE id_auteur = ?';
        $res = $cnx->getRows($qry, array($id), 1);
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        if (!empty($res)) {
            // le genre existe
            $id = $res[0]->id_auteur;
            $nom = $res[0]->nom_auteur;
            return new Genre($id, $nom);
        } else {
            return NULL;
        }
    }

    /**
     * ajoute un genre
     * @param   string  $code : le code du genre à ajouter
     * @param   string  $libelle : le libellé du genre à ajouter
     * @return  nombre de lignes affectées
     */
    public static function addGenre($code, $libelle) {
        $cnx = new PdoDao();
        $qry = 'INSERT INTO genre VALUES (?,?)';
        $res = $cnx->execSQL($qry, array(// nb de lignes affectées
            $code,
            $libelle
                )
        );
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

  /**
    * calcule le nombre d'ouvrages pour un genre
    * @param type $code : le code du genre
    * @return le nombre d'ouvrages du genre
    */
    public static function countOuvragesGenre($code){
        $cnx = new PdoDao();
        $qry = 'SELECT COUNT(*) FROM ouvrage WHERE code_genre = ?';
        $res = $cnx->getValue($qry,array($code));
        if (is_a($res,'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }


    /**
     * supprime un genre
     * @param   int $code : le code du genre à supprimer
     * @return le nombre de lignes affectées
    */
    public static function delGenre($code) {
        $cnx = new PdoDao();
        $qry = 'DELETE FROM genre WHERE code_genre = ?';
        $res = $cnx->execSQL($qry,array($code));
        if (is_a($res,'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

    public static function setGenre($unGenre) {
        $cnx = new PdoDao();
        $qry = 'UPDATE genre SET lib_genre = ? WHERE code_genre = ?';
        $res = $cnx->execSQL($qry,array(
            $unGenre->getLibelle(),
            $unGenre->getCode()
         ));
        if (is_a($res,'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

}
?>
