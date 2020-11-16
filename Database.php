<?php

/**
 * 
 * TODO : � compl�ter
 * 
 * Auteur : 
 * Date : 
 * Description :
 */


 class Database {


    // Variable de classe
    private $connector;

    /**
     * Fait la connexion à la base de donnée
     */
    public function __construct(){

        $this->connector = new PDO('mysql:host=localhost;dbname=db_nickname_jersteiner;charset=utf8', 'userFilRouge', '.Etml-'); //connection
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

        $this->unsetData($req);

        return $teachers;// retour tous les enseignants
    }

    /**
     * TODO: � compl�ter
     */
    public function getOneTeacher($id){

        // TODO: r�cup�re la liste des informations pour 1 enseignant
        // TODO: avoir la requ�te sql pour 1 enseignant (utilisation de l'id)
        // TODO: appeler la m�thode pour executer la requ�te
        // TODO: appeler la m�thode pour avoir le r�sultat sous forme de tableau
        // TODO: retour l'enseignant

        $req = $this->queryPrepareExecute('SELECT * FROM t_teacher WHERE idTeacher = ' . $id, null); // appeler la méthode pour executer la requète

        $teachers = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        $this->unsetData($req);

        return $teachers[0];// retour tous les enseignants
    }

    /**
     * Undocumented function
     *
     * @param array() $teacher
     * @return void
     */
    public function insertTeacher($teacher){

        // TODO : remplir
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