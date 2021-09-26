<?php

// Controlador sector
//Fabio Benitez Ramirez

require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once "models/Sector.php";
require_once "models/Sector_Usuario.php";

/**
 * Class SectorController
 * @author Fabio Benitez Ramirez 
 */
class SectorController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function mostrar() {

        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $usuario = Usuario::find($sesion->getUsuario());
            $esAdmin = $usuario->getRol();

            $dat = Sector::findAll();


            if ($esAdmin == "admin") {
                echo $this->twig->render("showSector.php.twig", ['dat' => $dat]);
            } else {
                header("Location: index.php");
            }
        } else {



            header("Location: index.php");
        }
    }

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

    public function anadirSector() {

        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {

            if (isset($_GET["nombre"])) {
                $nombre = $_GET["nombre"];
                $sector = new Sector();


                $sector->setNombre($nombre);



                $sector->anadir();

                header("location: index.php?con=Sector&ope=mostrar");
            } else {
                header("location: index.php?con=sector&ope=mostrar");
            }
        } else {


            header("Location: index.php");
        }
    }

    public function eliminarSector() {

        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $id = $_GET['id'];
            $sec = Sector::eliminarSector($id);

            header("Location: index.php?con=Sector&ope=mostrar");
        } else {


            header("Location: index.php");
        }
    }

    public function editarSector() {


        $idSector = $_GET["idSector"];


        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $idSector = $_GET["idSector"];


            if (isset($_GET["nombre"])) {
                $nombre = $_GET["nombre"];

                $sector = new Sector();


                $sector->setNombre($nombre);



                $sector->editar($idSector);

                header("location: index.php?con=Sector&ope=mostrar");
            }
        } else {


            header("Location: index.php");
        }
    }

}
