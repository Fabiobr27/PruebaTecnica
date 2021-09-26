<?php

// Controlador usuario
//Fabio Benitez Ramirez

require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once "models/Sector.php";
require_once "models/Sector_Usuario.php";
require_once "models/Usuario.php";

/**
 * Class UsuarioController
 * @author Fabio Benitez Ramirez 
 */
class UsuarioController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    //Muestra el formulario para vincular los sectores
    public function showvincularSectores() {

        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $usuario = Usuario::find($sesion->getUsuario());
            $esAdmin = $usuario->getRol();
            $idUsuario = $_GET["idUsuario"];
            $dat = Usuario::find($idUsuario);
            $secVin = Sector::findSectoresVinculado($idUsuario);
            $data = Sector::findAll();


            if ($esAdmin == "admin") {
                echo $this->twig->render("showVincularSectores.php.twig", ['dat' => $dat, 'secVin' => $secVin, 'data' => $data]);
            } else {
                header("Location: index.php");
            }
        } else {



            header("Location: index.php");
        }
    }

    public function mostrar() {

        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $usuario = Usuario::find($sesion->getUsuario());
            $esAdmin = $usuario->getRol();

            $dat = Usuario::findAll();



            if ($esAdmin == "admin") {
                echo $this->twig->render("showUsuarios.php.twig", ['dat' => $dat]);
            } else {
                header("Location: index.php");
            }
        } else {



            header("Location: index.php");
        }
    }

    //muestra los sectores vinculados de los clientes
    public function mostrarVinculados() {

        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $usuario = Usuario::find($sesion->getUsuario());
            $esAdmin = $usuario->getRol();

            $idUsu = $sesion->getUsuario();
            $dat = Sector::findSectorVinculado($idUsu);
            $sec = Sector::findAll();

            if ($esAdmin == "cliente") {
                echo $this->twig->render("showSectoresVinculados.php.twig", ['dat' => $dat, 'sec' => $sec]);
            } else {
                header("Location: index.php");
            }
        } else {



            header("Location: index.php");
        }
    }

    public function registro() {

        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {

            if (isset($_GET["nombre"])) {
                $nombre = $_GET["nombre"];
                $apellido = $_GET["apellido"];
                $email = $_GET["email"];
                $pass = $_GET["pass"];

                $usuario = new usuario();


                $usuario->setNombreUsuario($nombre);
                $usuario->setApellido($apellido);
                $usuario->setEmail($email);
                $usuario->setPass($pass);




                $usuario->anadir();

                header("location: index.php?con=Usuario&ope=mostrar");
            } else {
                header("location: index.php?con=Usuario&ope=mostrar");
            }
        } else {


            header("Location: index.php");
        }
    }

    public function eliminarUsuario() {

        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $id = $_GET['id'];
            $usu = Usuario::eliminarUsuario($id);

            header("Location: index.php?con=Usuario&ope=mostrar");
        } else {


            header("Location: index.php");
        }
    }

    public function editarUsuario() {



        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $idUsuario = $_GET["idUsuario"];


            if (isset($_GET["nombre"])) {
                $nombre = $_GET["nombre"];
                $apellido = $_GET["apellido"];
                $email = $_GET["email"];
                $rol = $_GET["rol"];

                $usuario = new usuario();


                $usuario->setNombreUsuario($nombre);
                $usuario->setApellido($apellido);
                $usuario->setEmail($email);
                $usuario->setRol($rol);




                $usuario->editar($idUsuario);

                header("location: index.php?con=Usuario&ope=mostrar");
            }
        } else {


            header("Location: index.php");
        }
    }

    public function vincularSector() {

        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {

            if (isset($_GET["sector"])) {
                $sector = $_GET["sector"];
                $idUsuario = $_GET["idUsuario"];
                $sector_usuario = new sector_usuario();


                $sector_usuario->setIdSector($sector);
                $sector_usuario->setIdUsuario($idUsuario);


                $sector_usuario->anadir();

                header("location: index.php?con=Usuario&ope=showUsuarios");
            } else {
                header("location: index.php?con=Usuario&ope=showUsuarios");
            }
        } else {


            header("Location: index.php");
        }
    }

}
