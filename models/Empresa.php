<?php

// Modelo Empresa
//Fabio Benitez Ramirez
require_once "libs/Database.php";
require_once "models/Sector.php";

/**
 * Class Empresa
 * @author Fabio Benitez Ramirez 
 */
class Empresa {

   
    public $nombreEmpresa;

   
    public $idEmpresa;

    public $telefono;

   
    public $email;
 
    public $sector;

    public function __construct() {
        
    }

    function getNombre(): mixed {
        return $this->nombreEmpresa;
    }

    function getId(): mixed {
        return $this->idEmpresa;
    }

    function getTelefono(): mixed {
        return $this->telefono;
    }

    function getEmail(): mixed {
        return $this->email;
    }

    function getSector() {
        return $this->sector;
    }

    function setNombre(mixed $nombre): void {
        $this->nombreEmpresa = $nombre;
    }

    function setId(mixed $id): void {
        $this->idEmpresa = $id;
    }

    function setTelefono(mixed $telefono): void {
        $this->telefono = $telefono;
    }

    function setEmail(mixed $email): void {
        $this->email = $email;
    }

    function setSector($sector): void {
        $this->sector = $sector;
    }

 
    public static function findAll() {
        $db = Database::getInstance();
        $db->query("SELECT * FROM Empresa e , Sector s WHERE E.Sector =  s.Id order by idEmpresa ;");

        $data = [];
        while ($obj = $db->getObject("Empresa"))
            array_push($data, $obj);


        return $data;
    }

    public static function findSector() {
        $db = Database::getInstance();
        $db->query("SELECT * FROM  Sector  ;");

        $data = [];
        while ($obj = $db->getObject("Sector"))
            array_push($data, $obj);


        return $data;
    }

    public static function find($idEmpresa) {
        $db = Database::getInstance();
        $db->query("SELECT * from Empresa WHERE idEmpresa = $idEmpresa;");
        $data = [];
        while ($obj = $db->getObject("Empresa"))
            array_push($data, $obj);


        return $data;
    }

    public static function eliminarEmpresa($idEmpresa) {
        $db = Database::getInstance();
        $db->query("DELETE FROM empresa WHERE idEmpresa =$idEmpresa;");
        
    }

    public function editar($idEmpresa) {
        $db = Database::getInstance();
        $sql = "UPDATE Empresa SET nombreEmpresa='{$this->nombreEmpresa}' , telefono='{$this->telefono}' , email= '{$this->email}', sector='{$this->sector}' WHERE idEmpresa=$idEmpresa";
        $db->query($sql);
    }
    
      public function anadir() {
        $db = Database::getInstance();
        $sql = "INSERT INTO `empresa`( `nombreEmpresa`, `telefono`, `email`, `sector`) VALUES ('{$this->nombreEmpresa}','{$this->telefono}', '{$this->email}','{$this->sector}');";
        $db->query($sql);
        
       
    }
       public static function filter($tit) {
        $sql = "SELECT * FROM  Empresa WHERE nombreEmpresa like   '%" . $tit . "%' ";

        $db = Database::getInstance();
        $db->query($sql);
        $listado = [];
        while ($filtro = $db->getObject("Empresa"))
            array_push($listado, $filtro);

        return $listado;
    }


}
