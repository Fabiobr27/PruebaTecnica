<?php

// Modelo Sector_usuario
//Fabio Benitez Ramirez
require_once 'models/Sector.php';
require_once 'models/Usuario.php';
require_once 'models/Empresa.php';
require_once "libs/Sesion.php";

/**
 * class Sector_Usuario
 * @author Fabio Benitez Ramirez
 */
class sector_usuario {

    private $idSector_usu;
    private $idUsuario;
    private $idSector;

    public function __construct() {
        
    }

    function getIdSector_usu(): mixed {
        return $this->idSector_usu;
    }

    function getIdUsuario(): mixed {
        return $this->idUsuario;
    }

    function getIdSector(): mixed {
        return $this->idSector;
    }

    function setIdSector_usu(mixed $idSector_usu): void {
        $this->idSector_usu = $idSector_usu;
    }

    function setIdUsuario(mixed $idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    function setIdSector(mixed $idSector): void {
        $this->idSector = $idSector;
    }

    public static function findSectorVinculado($idUsu): sector_usuario {


        $db = Database::getInstance();
        $db->query("Select * FROM sector s , sector_usuario su , usuario u , empresa e where u.idUsuario = su.idUsuario and u.idUsuario = 1 and su.idSector = s.id and e.sector = s.id;");
        $data = [];
        while ($obj = $db->getObject("sector_usuario"))
            array_push($data, $obj);


        return $data;
    }

    public function anadir() {
        $db = Database::getInstance();
        $sql = "INSERT INTO `sector_usuario`(`idSector`, `idUsuario`) VALUES ('{$this->idSector}' , '{$this->idUsuario}');";
        $db->query($sql);
    }

}
