<?php

/**
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * Database, permet d'accèder à la database avec les droit du fichier config.ini.php
 * TODO : plugin : PHP DocBlocker
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
        
        $req = $this->connector->prepare($query); // requette

        if ($binds != null)
        {
            foreach($binds as $bind)
            {
                $req->bindValue($bind['marker'], $bind['var'], $bind['type']);
            }
        }
        
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
     * détruit la requete et le connecteur
     *
     * @param [type] $req
     * @return void
     */
    private function unsetData($req){
        $req->closeCursor();
        //$this->destroyConnector();
    }

    /**
     * détruit le connecteur
     *
     * @return void
     */
    private function destroyConnector(){
        $this->connector = null;
        unset($this->connector);
    }

    /**
     * récupère tous les enseignants de la database
     *
     * @return array()
     */
    public function getAllTeachers(){
        
        $req = $this->queryPrepareExecute('SELECT * FROM t_teacher', null);// appeler la méthode pour executer la requète

        $teachers = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        $this->unsetData($req); // vide le jeu d'enregistrement

        return $teachers;// retour tous les enseignants
    }

    /**
     * permet d'obtenir un prof depuis son id
     *
     * @param int $id
     * @return array()
     */
    public function getOneTeacher($id){

        $values = array(
            1 => array(
                'marker' => ':id',
                'var' => $id,
                'type' => PDO::PARAM_INT
            ),
        );

        $req = $this->queryPrepareExecute('SELECT * FROM t_teacher WHERE idTeacher = :id', $values); // appeler la méthode pour executer la requète

        $teachers = $this->formatData($req); // appel de la méthode pour avoir le résultat sous forme de tableau

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

        $values = array(
            1 => array(
                'marker' => ':surname',
                'var' => $teacher["name"],
                'type' => PDO::PARAM_STR
            ),
            2 => array(
                'marker' => ':firstname',
                'var' => $teacher["firstname"],
                'type' => PDO::PARAM_STR
            ),
            3 => array(
                'marker' => ':gender',
                'var' => $teacher["gender"],
                'type' => PDO::PARAM_STR
            ),
            4 => array(
                'marker' => ':nickname',
                'var' => $teacher["nickname"],
                'type' => PDO::PARAM_STR
            ),
            5 => array(
                'marker' => ':origineNickname',
                'var' => $teacher["origineNickname"],
                'type' => PDO::PARAM_STR
            ),
            6 => array(
                'marker' => ':section',
                'var' => $teacher["section"],
                'type' => PDO::PARAM_INT
            )
        );

        $query =    "INSERT INTO t_teacher (teaLastName, teaFirstName, teaGender, teaNickname, teaNicknameOrigin, idSection) 
                    VALUES (:surname, :firstname, :gender, :nickname, :origineNickname, :section)";

        $req = $this->queryPrepareExecute($query, $values); // appeler la méthode pour executer la requète
        
        $this->unsetData($req);
    }

    /**
     * ajout une section dans la base de dopnnée
     *
     * @param array() $section
     * @return void
     */
    public function insertSection($section){

        $values = array(
            1 => array(
                'marker' => ':secName',
                'var' => $section["sectionName"],
                'type' => PDO::PARAM_STR
            )
        );

        $query =    "INSERT INTO t_section (secName) 
                    VALUES (:secName)";

        $req = $this->queryPrepareExecute($query, $values); // appeler la méthode pour executer la requète
        
        $this->unsetData($req);
    }

    /**
     * permet d'inserer un utilisateur dans la base de donnée
     * 
     * @param array $user
     * @return void
     */
    public function insertUser($user){

        $values = array(
            1 => array(
                'marker' => ':useUsername',
                'var' => $user["useUsername"],
                'type' => PDO::PARAM_STR
            ),
            2 => array(
                'marker' => ':usePassword',
                'var' => password_hash($user["usePassword"], PASSWORD_BCRYPT),
                'type' => PDO::PARAM_STR
            ),
            3 => array(
                'marker' => ':useAdminRight',
                'var' => $user["useAdminRight"],
                'type' => PDO::PARAM_INT
            )
        );

        $query =    "INSERT INTO t_user (useUsername, usePassword, useAdminRight) 
                    VALUES (:useUsername, :usePassword, :useAdminRight)";

        $req = $this->queryPrepareExecute($query, $values); // appeler la méthode pour executer la requète
        
        $this->unsetData($req);
    }

    /**
     * permet de retirer un prof de la base de donnée
     *
     * @param int $id
     * @return void
     */
    public function deleteTeacher($id)
    {
        $values = array(
            1 => array(
                'marker' => ':id',
                'var' => $id,
                'type' => PDO::PARAM_INT
            ),
        );

        $query = "DELETE FROM t_teacher WHERE t_teacher.idTeacher = :id";

        $req = $this->queryPrepareExecute($query, $values);

        $this->unsetData($req);
    }

    /**
     * permet de retirer une section de la base de donnée
     *
     * @param int $id
     * @return bool
     */
    public function deleteSection($id)
    {
        $teachers = $this->getAllTeachers();

        foreach($teachers as $teacher) // vérifier qu'aucun prof n'est dans cette section
        {
            if ($teacher["idSection"] == $id)
            {
                return false;
            }
        }

        $values = array(
            1 => array(
                'marker' => ':id',
                'var' => $id,
                'type' => PDO::PARAM_INT
            ),
        );

        $query = "DELETE FROM t_section WHERE t_section.idSection = :id";

        $req = $this->queryPrepareExecute($query, $values);

        $this->unsetData($req);

        return true;
    }

    /**
     * permet de supprimer un utilisateur de la base de donnée
     * 
     * @param int $id
     * @return void
     */
    public function deleteUser($id)
    {
        $values = array(
            1 => array(
                'marker' => ':id',
                'var' => $id,
                'type' => PDO::PARAM_INT
            ),
        );

        $query = "DELETE FROM t_user WHERE t_user.idUser = :id";

        $req = $this->queryPrepareExecute($query, $values);

        $this->unsetData($req);
    }

    /**
     * permet d'obtenir toutes les sections
     *
     * @return array
     */
    public function getAllSections(){
        //$req = $this->queryPrepareExecute('SELECT * FROM t_section', null);
        $req = $this->queryPrepareExecute('SELECT t_section.idSection, t_section.secName, Count(t_teacher.idTeacher) as "nbrTeacher" FROM t_section LEFT JOIN t_teacher 
        ON t_teacher.idSection = t_section.idSection GROUP BY t_section.idSection', null);// appeler la méthode pour executer la requète

        $sections = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        $this->unsetData($req);

        return $sections;// retour tous les sections
    }

    /**
     * permet d'obtenir la section ayant l'id passé en param
     * 
     * @param int $id
     * @return array
     */
    public function getOneSection($id){

        $req = $this->queryPrepareExecute('SELECT * FROM t_section WHERE idSection = ' . $id, null); // appeler la méthode pour executer la requète

        $sections = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        $this->unsetData($req);

        return $sections[0];// section désiré
    }

    /**
     * permet d'obtenir toutes les sections et de modifier l'instance courant du prof passé en parametre
     * 
     * @param int $id
     * @param array $teacher
     * @return array
     */
    public function getAllSectionsAndThisTeacher($id, &$teacher)
    {
        $req = $this->queryPrepareExecute('SELECT * FROM t_section', null);// appeler la méthode pour executer la requète

        $sections = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        $values = array(
            1 => array(
                'marker' => ':id',
                'var' => $id,
                'type' => PDO::PARAM_INT
            ),
        );

        //$this->unsetData($req); // vide le jeu d'enregistrement

        $teacher = $this->getOneTeacher($id);// appeler la méthode pour avoir le résultat sous forme de tableau

        //$this->unsetData($req); // vide le jeu d'enregistrement

        return $sections;
    }

    /**
     * permet de modifier un prof dans la base de donnée
     * 
     * @param int $id
     * @param array $teacher
     * @return void
     */
    public function editTeacher($idTeacher,  $teacher)
    {
        $values = array(
            1 => array(
                'marker' => ':surname',
                'var' => $teacher["name"],
                'type' => PDO::PARAM_STR
            ),
            2 => array(
                'marker' => ':firstname',
                'var' => $teacher["firstname"],
                'type' => PDO::PARAM_STR
            ),
            3 => array(
                'marker' => ':gender',
                'var' => $teacher["gender"],
                'type' => PDO::PARAM_STR
            ),
            4 => array(
                'marker' => ':nickname',
                'var' => $teacher["nickname"],
                'type' => PDO::PARAM_STR
            ),
            5 => array(
                'marker' => ':origineNickname',
                'var' => $teacher["origineNickname"],
                'type' => PDO::PARAM_STR
            ),
            6 => array(
                'marker' => ':section',
                'var' => $teacher["section"],
                'type' => PDO::PARAM_INT
            )
        );

        $query =   'UPDATE t_teacher SET 
                    teaLastName = :surname, teaFirstName = :firstname, teaGender = :gender,
                    teaNickname = :nickname, teaNicknameOrigin = :origineNickname, idSection = :section
                    WHERE idTeacher = ' . $idTeacher;

        $req = $this->queryPrepareExecute($query, $values);

        $this->unsetData($req);
    }

    /**
     * permet de modifier une section dans la base de donnée
     * 
     * @param int $id
     * @param array $section
     * @return void
     */
    public function editSection($idSection,  $section)
    {
        $values = array(
            1 => array(
                'marker' => ':secName',
                'var' => $section["secName"],
                'type' => PDO::PARAM_STR
            )
        );

        $query =   'UPDATE t_section SET secName = :secName WHERE idSection = ' . $idSection;

        $req = $this->queryPrepareExecute($query, $values);

        $this->unsetData($req);
    }

    /**
     * permet d'obtenir tout les utilisateur de la database
     *
     * @return array
     */
    public function getAllUsers()
    {
        $req = $this->queryPrepareExecute('SELECT * FROM t_user', null);// appeler la méthode pour executer la requète

        $users = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        $this->unsetData($req);

        return $users;// retour tous les users
    }

    /**
     * vérifie dans la database si un utilisateur a le même username
     *
     * @param string $username
     * @return void
     */
    public function userExist($username)
    {
        $req = $this->queryPrepareExecute('SELECT * FROM t_user', null);// appeler la méthode pour executer la requète

        $users = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        foreach($users as $user)
        {
            if ($user["useUsername"] == $username)
            {
                return true;
            }
        }

        return false;
    }

    /**
     * vérifie si le teacher avec l'id donné exist
     *
     * @param int $idTeacher
     * @return void
     */
    public function teacherExist($idTeacher)
    {
        $req = $this->queryPrepareExecute('SELECT * FROM t_teacher', null);// appeler la méthode pour executer la requète

        $techers = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        foreach($techers as $teacher)
        {
            if ($teacher["idTeacher"] == $idTeacher)
            {
                return true;
            }
        }

        return false;
    }

    public function sectionExist($idSection)
    {
        $req = $this->queryPrepareExecute('SELECT * FROM t_section', null);// appeler la méthode pour executer la requète

        $sections = $this->formatData($req);// appeler la méthode pour avoir le résultat sous forme de tableau

        foreach($sections as $section)
        {
            if ($section["idSection"] == $idSection)
            {
                return true;
            }
        }

        return false;
    }

    public function verifyPassword($username, $password)
    {
        $values = array(
            1 => array(
                'marker' => ':username',
                'var' => $username,
                'type' => PDO::PARAM_STR
            ),
        );

        $req = $this->queryPrepareExecute('SELECT usePassword FROM t_user WHERE useUsername = :username', $values);

        $hashedPassword = $this->formatData($req)[0]["usePassword"];
        //var_dump($hashedPassword);

        return password_verify($password, $hashedPassword); 
    }

    public function getUserRight($username)
    {
        $values = array(
            1 => array(
                'marker' => ':username',
                'var' => $username,
                'type' => PDO::PARAM_STR
            ),
        );

        $req = $this->queryPrepareExecute('SELECT useAdminRight FROM t_user WHERE useUsername = :username', $values);

        $right = $this->formatData($req)[0]["useAdminRight"];

        return $right; 
    }

    // + tous les autres méthodes dont vous aurez besoin pour la suite (insertTeacher ... etc)
 }


?>