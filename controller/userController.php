<?php
/**
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * Controler pour gérer les utilisateurs
 */

//include_once 'model/CustomerRepository.php';

class UserController extends Controller {

    /**
     * Permet de choisir l'action à effectuer
     *
     * @return mixed
     */
    public function display() {

        $action = "";
        
        switch($_GET["action"])
        {
            case "manageUsers":
                $action = "manageUsersAction";
                break;

            case "addUser":
                $action = "addUserAction";
                break;

            case "deleteUser":
                $action = "deleteUserAction";
                break;

            case "insertUser":
                $action = "insertUserAction";
                break;

            default:
                $action = "manageUsersAction";
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
    private function manageUsersAction() {

        include_once("Database.php");
		$database = new Database();
		$users = $database->getAllUsers();

        // Charge le fichier pour la vue
        $view = file_get_contents('view/page/user/manageUsers.php');


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
     * permet d'accèder à la page d'ajout d' un compte
     *
     * @return void
     */
    private function addUserAction() {

        $view = file_get_contents('view/page/user/addUser.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * permet de delete un utilisateur
     * 
     * @return string
     */
    private function deleteUserAction() {
        include_once("Database.php");
		$database = new Database();

        $view = file_get_contents('view/page/user/deleteUser.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }

    /**
     * permet d'atteindre la page d'insertion d'utilisateur
     * 
     * @return string
     */
    private function insertUserAction() {
        include_once("Database.php");
		$database = new Database();

        $view = file_get_contents('view/page/user/insertUser.php');
        ob_start();
        eval('?>' . $view);
        $content = ob_get_clean();

        return $content;
    }
}