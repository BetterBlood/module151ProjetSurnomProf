<?php
/**
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * Controler pour gérer les pages teacher
 */

//include_once 'model/CustomerRepository.php';

class TeacherController extends Controller {

    /**
     * Permet de choisir l'action à effectuer
     *
     * @return mixed
     */
    public function display() {

        $action = "listAction";

        if (array_key_exists("userPermissionsNumber", $_SESSION))
        {
            $userLVL = $_SESSION["userPermissionsNumber"];

            if (!array_key_exists("action", $_GET))
            {
                $action = "listAction";
            }
            else 
            {
                switch($_GET["action"])
                {
                    case "list":
                        $action = "listAction";
                        break;

                    case "detail":
                        if ($userLVL > 0)
                        {
                            $action = "detailAction";
                        }
                        else
                        {
                            $action = "listAction";
                        }
                        break;

                    case "addTeacher":
                        if ($userLVL >= 50)
                        {
                            $action = "addTeacherAction";
                        }
                        else
                        {
                            $action = "listAction";
                        }
                        break;

                    case "editTeacher":
                        if ($userLVL >= 75)
                        {
                            $action = "editTeacherAction";
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
            }
        }
        else 
        {
            $action = "listAction";
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

        if (array_key_exists("teacherInModification", $_SESSION))
        {
            unset($_SESSION["teacherInModification"]);
        }
        if (array_key_exists("idTeacherInModification", $_SESSION))
        {
            unset($_SESSION["idTeacherInModification"]);
        }

        if (array_key_exists("error", $_SESSION))
        {
            unset($_SESSION["error"]);
        }
        if (array_key_exists("surname", $_SESSION))
        {
            unset($_SESSION["surname"]);
        }
        if (array_key_exists("gender", $_SESSION))
        {
            unset($_SESSION["gender"]);
        }
        if (array_key_exists("nickname", $_SESSION))
        {
            unset($_SESSION["nickname"]);
        }
        if (array_key_exists("origineNickname", $_SESSION))
        {
            unset($_SESSION["origineNickname"]);
        }
        if (array_key_exists("section", $_SESSION))
        {
            unset($_SESSION["section"]);
        }
        

        // Instancie le modèle et va chercher les informations
        //$customerRepository = new CustomerRepository();
        //$customers = $customerRepository->findAll(); // est utiliser a la ligne 45

        include_once("model/Database.php");
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

        include_once("model/Database.php");
        $database = new Database();

        if (array_key_exists("id", $_GET) && $database->teacherExist($_GET['id']))
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
     * @return string
     */
    private function addTeacherAction() {
        include_once("model/Database.php");
		$database = new Database();
        $sections = $database->getAllSections();

        $view = file_get_contents('view/page/teacher/addTeacher.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * permet d'accèder a la page de modification de prof
     * 
     * @return string
     */
    private function editTeacherAction()
    {
        include_once("model/Database.php");
        $database = new Database();
        $teacher = array();

        if (array_key_exists("id", $_GET))
        {
            $sections = $database->getAllSectionsAndThisTeacher($_GET['id'], $teacher);
        }

        $view = file_get_contents('view/page/teacher/updateTeacher.php');

        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}