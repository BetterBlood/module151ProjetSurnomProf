<?php
/**
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * Controler pour gérer les pages sections
 */

//include_once 'model/CustomerRepository.php';

class SectionController extends Controller {

    /**
     * Permet de choisir l'action à effectuer
     *
     * @return mixed
     */
    public function display() {

        $action = "";

        $userLVL = 1;

        if (array_key_exists("userPermissionsNumber", $_SESSION))
        {
            $userLVL = $_SESSION["userPermissionsNumber"];
        }
        
        
        switch($_GET["action"])
        {
            case "addSection":
            case "insertSection":
            case "editSection":
                if ($userLVL >= 75)
                {
                    $action = $_GET["action"] . 'Action';
                }
                else
                {
                    $action = "listAction";
                }
                break;

            case "list":
            case "detail":
                if ($userLVL >= 1)
                {
                    $action = $_GET["action"] . 'Action';
                }
                else
                {
                    $action = "listAction";
                }
                break;

            default:
                $action = "listAction";
                break;
        }
        //$action = $_GET['action'] . "Action"; // exemple

        // Appelle une méthode dans cette classe (ici, ce sera le nom + action (ex: listAction, detailAction, ...))
        return call_user_func(array($this, $action)); // permet d'appeler listAction() (ligne 31)
    }

    /**
     * Rechercher les données et les passe à la vue (en liste)
     *
     * @return string
     */
    private function listAction() {

        include_once("model/Database.php");
		$database = new Database();
        $sections = $database->getAllSections();
        

        // Charge le fichier pour la vue
        $view = file_get_contents('view/page/section/list.php');


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

        include_once("model/Database.php");
        $database = new Database();

        if (array_key_exists("id", $_GET) && $database->sectionExist($_GET['id']))
        {
            $section = $database->getOneSection($_GET['id']);
        }

        //$customerRepository = new CustomerRepository();
        //$customer = $customerRepository->findOne($_GET['id']);

        $view = file_get_contents('view/page/section/detail.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * permet d'accèder à la page d'ajout de section
     *
     * @return void
     */
    private function addSectionAction() {

        $view = file_get_contents('view/page/section/addSection.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * permet d'atteindre la page d'insertion de section
     * 
     * @return string
     */
    private function insertSectionAction() {
        include_once("model/Database.php");
		$database = new Database();

        $view = file_get_contents('view/page/user/insertSection.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * permet d'accèder a la page de modification de la section
     * 
     * @return string
     */
    private function editSectionAction()
    {
        include_once("model/Database.php");
        $database = new Database();
        $section = array();

        if (array_key_exists("id", $_GET))
        {
            $section = $database->getOneSection($_GET['id']);
        }
        

        $view = file_get_contents('view/page/section/updateSection.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}