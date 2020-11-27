<?php
/**
 * ETML
 * Auteur : Cindy Hardegger
 * Date: 22.01.2019
 * Controler pour gérer les clients
 */

//include_once 'model/CustomerRepository.php';

class TeacherController extends Controller {

    /**
     * Permet de choisir l'action à effectuer
     *
     * @return mixed
     */
    public function display() {

        $action = $_GET['action'] . "Action";

        // Appelle une méthode dans cette classe (ici, ce sera le nom + action (ex: listAction, detailAction, ...))
        return call_user_func(array($this, $action)); // permet d'appeler listAction() (ligne 31)
    }

    /**
     * Rechercher les données et les passe à la vue (en liste)
     *
     * @return string
     */
    private function listAction() {

        // Instancie le modèle et va chercher les informations
        //$customerRepository = new CustomerRepository();
        //$customers = $customerRepository->findAll(); // est utiliser a la ligne 45

        include_once("Database.php");
		$database = new Database();
		$teachers = $database->getAllTeachers();

        // Charge le fichier pour la vue
        $view = file_get_contents('view/page/teacher/list.php');


        // Pour que la vue puisse afficher les bonnes données, il est obligatoire que les variables de la vue puisse contenir les valeurs des données
        // ob_start est une méthode qui stoppe provisoirement le transfert des données (donc aucune donnée n'est envoyée).
        ob_start();
        // eval permet de prendre le fichier de vue et de le parcourir dans le but de remplacer les variables PHP par leur valeur (provenant du model)
        eval('?>' . $view);
        // ob_get_clean permet de reprendre la lecture qui avait été stoppée (dans le but d'afficher la vue)
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Rechercher les données et les passe à la vue (en détail)
     *
     * @return string
     */
    private function detailAction() {

        include_once("Database.php");
        $database = new Database();
        if (array_key_exists("id", $_GET))
        {
            $teacher = $database->getOneTeacher($_GET['id']);
        }
        //$customerRepository = new CustomerRepository();
        //$customer = $customerRepository->findOne($_GET['id']);

        $view = file_get_contents('view/page/teacher/detail.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * permet d'accèder à la page d'ajout de prof
     *
     * @return void
     */
    private function addTeacherAction() {
        include_once("Database.php");
		$database = new Database();
        $sections = $database->getAllSections();

        $view = file_get_contents('view/page/teacher/addTeacher.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}