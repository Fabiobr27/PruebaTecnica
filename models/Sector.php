<?php

// Modelo Sector
//Fabio Benitez Ramirez
require_once "libs/Database.php";

/**
 * Class Sector
 * @author Fabio Benitez Ramirez 
 */
class Sector {

    public $nombreSector;
    public $id;

    public function __construct() {
        
    }

    function getNombre(): mixed {
        return $this->nombreSector;
    }

    function getId(): mixed {
        return $this->id;
    }

    function setNombre(mixed $nombre): void {
        $this->nombreSector = $nombre;
    }

    function setId(mixed $id): void {
        $this->id = $id;
    }

    public static function findAll() {
        $db = Database::getInstance();
        $db->query("SELECT * FROM Sector ;");

        $data = [];
        while ($obj = $db->getObject("Sector"))
            array_push($data, $obj);


        return $data;
    }

    public function anadir() {
        $db = Database::getInstance();
        $sql = "INSERT INTO `sector`(`nombreSector`) VALUES ('{$this->nombreSector}');";
        $db->query($sql);
    }

    public static function eliminarSector($id) {
        $db = Database::getInstance();
        $db->query("DELETE FROM sector WHERE id =$id;");
        //echo 'DELETE FROM empresa WHERE idEmpresa ='.$idEmpresa;
    }

    public function editar($id) {
        $db = Database::getInstance();
        $sql = "UPDATE sector SET nombreSector='{$this->nombreSector}' WHERE id=$id";
        $db->query($sql);
    }

    public static function findSectorVinculado($idUsu): array {


        $db = Database::getInstance();
        $db->query("Select * FROM sector s , sector_usuario su , usuario u , empresa e where u.idUsuario = su.idUsuario and u.idUsuario = $idUsu and su.idSector = s.id and e.sector = s.id Order by s.id;");


        $data = [];
        while ($obj = $db->getObject("sector_usuario"))
            array_push($data, $obj);


        return $data;
    }

    public static function findSectoresVinculado($idUsu): array {


        $db = Database::getInstance();
        $db->query("Select Distinct su.idSector ,u.idUsuario , u.nombreUsuario , u.Apellido , s.nombreSector FROM sector s , sector_usuario su , usuario u  where u.idUsuario = su.idUsuario and u.idUsuario = $idUsu and su.idSector = s.id Order by s.id;");


        $data = [];
        while ($obj = $db->getObject("sector_usuario"))
            array_push($data, $obj);


        return $data;
    }

}
