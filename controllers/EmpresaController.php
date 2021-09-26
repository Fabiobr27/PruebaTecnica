<?php

// Controlador Empresa
//Fabio Benitez Ramirez

require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once "models/Empresa.php";
require_once "Controllers/SectorController.php";

/**
 * Class EmpresaController
 * @author Fabio Benitez Ramirez 
 */
class EmpresaController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function mostrar() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {

            $idUsu = $sesion->getUsuario();
            $dat = Empresa::findAll();
            $sec = Sector::findAll();


            echo $this->twig->render("showEmpresas.php.twig", ['dat' => $dat, 'sec' => $sec]);
        } else {


            header("Location: index.php");
        }
    }

    public function eliminarEmpresa() {
        $id = $_GET['id'];
        $emp = Empresa::eliminarEmpresa($id);

        header("Location: index.php?con=Empresa&ope=mostrar");
    }

    public function editarEmpresa() {


        $idEmpresa = $_GET["idEmpresa"];


        if (isset($_GET["nombre"])) {
            $nombre = $_GET["nombre"];
            $email = $_GET["email"];
            $telefono = $_GET["telefono"];
            $sector = $_GET["sector"];
            $empresa = new Empresa();


            $empresa->setNombre($nombre);
            $empresa->setEmail($email);
            $empresa->setTelefono($telefono);
            $empresa->setSector($sector);


            $empresa->editar($idEmpresa);

            header("location: index.php?con=Empresa&ope=mostrar");
        } else {
            echo"hola";
        }
    }

    public function anadirEmpresa() {

        if (isset($_GET["nombre"])) {
            $nombre = $_GET["nombre"];
            $email = $_GET["email"];
            $telefono = $_GET["telefono"];
            $sector = $_GET["sector"];
            $empresa = new Empresa();


            $empresa->setNombre($nombre);
            $empresa->setEmail($email);
            $empresa->setTelefono($telefono);
            $empresa->setSector($sector);


            $empresa->anadir();

            header("location: index.php?con=Empresa&ope=mostrar");
        } else {
            header("location: index.php?con=Empresa&ope=mostrar");
        }
    }

    public function filtro() {

        $tit = $_GET["nomb"];
        $dat = Empresa::filter($tit);

        echo $this->twig->render("showfiltro.php.twig", ['dat' => $dat]);
    }

}
