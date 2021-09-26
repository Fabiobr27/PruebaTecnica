<?php

require_once "models/Empresa.php";
require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once("libs/Database.php");

/**
 * Class loginController
 * @author Fabio Benitez Ramirez
 */
class loginController extends BaseController {

    private $error = false;

    public function __construct() {
        parent::__construct();
    }

    public function show() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $usuario = Usuario::find($sesion->getUsuario());
            $esAdmin = $usuario->getRol();


            if ($esAdmin == "admin") {
                $this->goMainAdmin();
            } else {
                $this->goMain($sesion->getUsuario());
            }
        } else {
            echo $this->twig->render("showInicio.php.twig", ['error' => $this->error]);
        }
    }

    public function signin() {
        if (isset($_POST['email'])) {
            $ses = Sesion::getInstance();

            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $pass = isset($_POST['pass']) ? $_POST['pass'] : null;


            $existe = $ses->login($email, $pass);

            if ($existe) {

                $idUsu = $ses->getUsuario();
                $usuario = Usuario::find($idUsu);
                $esAdmin = $usuario->getRol();

                if ($esAdmin == "admin") {
                    $this->goMainAdmin();
                } else {
                    $this->goMain();
                }
            } else {
                $this->error = true;
                echo $this->twig->render("showInicio.php.twig", ['error' => $this->error]);
            }
        }
    }

    public function goMain($id = null) {

        $idUsu = $_GET["id"] ?? $id;
        $dat = Empresa::findAll();
        $sec = Sector::findAll();


        echo $this->twig->render("showMainCliente.php.twig", ['idUsu' => $idUsu]);
    }

    public function goMainAdmin($id = null) {

        $idUsu = $_GET["id"] ?? $id;
        $dat = Empresa::findAll();
        $sec = Sector::findAll();


        echo $this->twig->render("showMainAdmin.php.twig", ['idUsu' => $idUsu]);
    }

    public function logout() {
        $ses = Sesion::getInstance();
        $ses->close();
        $ses->redirect("index.php");
    }

    public function formulario() {


        echo $this->twig->render("showFormulario.php.twig");
    }

}
