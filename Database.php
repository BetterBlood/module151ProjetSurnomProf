<?php

/**
 * 
 * TODO : � compl�ter
 * 
 * Auteur : 
 * Date : 
 * Description :
 */

 include_once('config.ini.php');

 class Database {

    // Variable de classe
    private $connector;

    /**
     * Fait la connexion à la base de donnée
     */
    public function __construct(){
        $dbname     = $GLOBALS['MM_CONFIG_DATABASE']['dbname'];
        $username   = $GLOBALS["MM_CONFIG_DATABASE"]["username"];
        $pass       = $GLOBALS["MM_CONFIG_DATABASE"]["password"];
        $host       = $GLOBALS["MM_CONFIG_DATABASE"]["host"];
        $port       = $GLOBALS["MM_CONFIG_DATABASE"]["port"];
        $charset    = $GLOBALS["MM_CONFIG_DATABASE"]["charset"];

        try {
            $this->connector = new PDO(
                'mysql:host=' . $host . ";port=" . $port . ";dbname=" . $dbname . 
                ";charset=" . $charset, $username, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        }
        catch(Exception $e) {
            echo "Connexion DB impossible";
        }

        //$this->connector = new PDO('mysql:host=localhost;dbname=db_nickname_jersteiner;charset=utf8', 'userFilRouge', '.Etml-'); //connection
    }

    /**
     * simple requette
     *
     * @param [type] $query
     * @return void
     */
    private function querySimpleExecute($query){

        $req = $this->connector->query($query); // requette

        return $req;
    }

    /**
     * Undocumented function
     *
     * @param [type] $query
     * @param [type] $binds
     * @return PDOStatement
     */
    private function queryPrepareExecute($query, $binds){
        
        // TODO: permet de pr�parer, de binder et d�ex�cuter une requ�te (select avec where ou insert, update et delete)
        $req = $this->connector->prepare($query); // requette
        $req->execute();

        return $req;
    }

    /**
     * Undocumented function
     *
     * @param [type] $req
     * @return void
     */
    private function formatData($req){

        return $req->fetchALL(PDO::FETCH_ASSOC); // transformation en tableau associatif
    }

    /**
     * détrui le connector
     */
    private function unsetData($req){

        $this->connector = null;
        $req->closeCursor();
        unset($this->connector);
    }

    /**
     * récupère tous les enseignants de la database
     *
     * @return void
     */
    public function getAllTeachers(){
        
        $req = $this->queryPrepareExecute('SELECT * FROM t_teacher', null);// appeler la méthode pour executer la requète

        $teachers = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        $this->unsetData($req); // vide le jeu d'enregistrement

        return $teachers;// retour tous les enseignants
    }

    /**
     * permet d'obtenir un prof depuis son id
     */
    public function getOneTeacher($id){

        $req = $this->queryPrepareExecute('SELECT * FROM t_teacher WHERE idTeacher = ' . $id, null); // appeler la méthode pour executer la requète

        $teachers = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        $this->unsetData($req); // vide le jeu d'enregistrement

        return $teachers[0];// retour tous les enseignants
    }

    /**
     * ajout un prof dans la base de dopnnée
     *
     * @param array() $teacher
     * @return void
     */
    public function insertTeacher($teacher){

        $query = 'INSERT INTO t_teacher (teaFirstName,...) VALUES ('. $teacher["firstname"] .', ...'; // TODO : modifier pour fit le array de teacher

        $req = $this->queryPrepareExecute($query, null); // appeler la méthode pour executer la requète

        $this->unsetData($req);
    }

    /**
     * permet d'obtenir toutes les sections
     *
     * @return void
     */
    public function getAllSections(){
        
        $req = $this->queryPrepareExecute('SELECT * FROM t_section', null);// appeler la méthode pour executer la requète

        $sections = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        $this->unsetData($req);

        return $sections;// retour tous les sections
    }

    /**
     * permet d'obtenir la section ayant l'id passé en param
     */
    public function getOneSection($id){

        $req = $this->queryPrepareExecute('SELECT * FROM t_section WHERE idSection = ' . $id, null); // appeler la méthode pour executer la requète

        $sections = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        $this->unsetData($req);

        return $sections[0];// section désiré
    }

    // + tous les autres m�thodes dont vous aurez besoin pour la suite (insertTeacher ... etc)
 }


?>