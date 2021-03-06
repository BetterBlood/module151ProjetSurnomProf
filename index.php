<?php
session_start();

if (!array_key_exists("loged_in", $_SESSION))
{
    $_SESSION["loged_in"] = false;
    $_SESSION["userName"] = "";
    $_SESSION["userPassword"] = "";
}

/**
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * Site web en MVC et orienté objet, page d'index
 */

$debug = false;

if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

}
date_default_timezone_set('Europe/Zurich'); // pour les dates

include_once 'controller/Controller.php';
include_once 'controller/HomeController.php';
include_once 'controller/TeacherController.php';
include_once 'controller/userController.php';
include_once 'controller/sectionController.php';


class MainController {

    /**
     * Permet de sélectionner le bon contrôler et l'action
     */
    public function dispatch() {
        
        $currentLink = "";

        //gestion d'erreur de lien
        if (array_key_exists("controller", $_GET) && array_key_exists("action", $_GET))
        {
            $currentLink = $this->menuSelected($_GET['controller'], $_GET["action"]);
        }
        else if (array_key_exists("controller", $_GET))
        {
            $currentLink = $this->menuSelected($_GET['controller'], "index");
        }
        else if (array_key_exists("action", $_GET))
        {
            $currentLink = $this->menuSelected("home", $_GET["action"]);
        }
        else
        {
            $currentLink = $this->menuSelected("home", "index");
        }

        $this->viewBuild($currentLink);
    }

    /**
     * Selectionner la page et instancier le contrôleur
     *
     * @param string $page : page sélectionner
     * @return $link : instanciation d'un contrôleur
     */
    protected function menuSelected ($page) {

        $link = "";

        // attribution du controlleur
        switch($page){
            case 'home':
                $link = new HomeController();
                break;

            case 'teacher':
                $link = new TeacherController();
                break;

            case 'section':
                $link = new SectionController();
                break;

            case 'facture':
                $link = new FactureController();
                break;

            case 'user':
                if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 100)
                {
                    $link = new UserController();
                }
                else
                {
                    $_GET["action"] = "index";
                    $link = new HomeController();
                }
                break; 

            default:
                $link = new HomeController();
                break;
        }

        return $link;
    }

    /**
     * Construction de la page
     *
     * @param $currentPage : page qui doit s'afficher
     */
    protected function viewBuild($currentPage) {

        $content = $currentPage->display();

        include(dirname(__FILE__) . '/view/head.html');
        include(dirname(__FILE__) . '/view/header.php');
        include(dirname(__FILE__) . '/view/menu.php');
        echo $content;
        //include(dirname(__FILE__) . '/view/dynamicContent.php');
        include(dirname(__FILE__) . '/view/footer.html');
    }
}

/**
 * Affichage du site internet - appel du contrôleur par défaut
 */
$controller = new MainController();
$controller->dispatch();





