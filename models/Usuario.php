<?php

// Modelo Sector
//Fabio Benitez Ramirez
require_once "libs/Database.php";

/**
 * Class Usuario
 * @author Fabio Benitez Ramirez 
 */
class Usuario {

    public $idUsuario;
    public $nombreUsuario;
    public $apellido;
    public $email;
    public $pass;
    public $rol;

    function __construct() {
        
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getEmail() {
        return $this->email;
    }

    function getPass() {
        return $this->pass;
    }

    function getRol() {
        return $this->rol;
    }

    function setIdUsuario($idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    function setNombreUsuario($nombreUsuario): void {
        $this->nombreUsuario = $nombreUsuario;
    }

    function setApellido($apellido): void {
        $this->apellido = $apellido;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setPass($pass): void {
        $this->pass = $pass;
    }

    function setRol($rol): void {
        $this->rol = $rol;
    }

    public static function findAll() {
        $db = Database::getInstance();
        $db->query("SELECT * FROM Usuario ;");

        $data = [];
        while ($obj = $db->getObject("Usuario"))
            array_push($data, $obj);


        return $data;
    }

    public static function find(int $id): Usuario {
        $db = Database::getInstance();
        $db->query("SELECT * FROM usuario WHERE idUsuario = $id ;");


        return $db->getObject("Usuario");
    }

    public static function SectoresVinculados(int $id): Usuario {
        $db = Database::getInstance();
        $db->query("SELECT Distinct * FROM usuario u , sector_usuario su WHERE u.idUsuario = $id  and su.idUsuario = u.idUsuario ;");


        return $db->getObject("Usuario");
    }

    public function anadir() {
        $db = Database::getInstance();
        $sql = "INSERT INTO `usuario`(`nombreUsuario`, `Apellido`, `email`, `pass`) VALUES ('{$this->nombreUsuario}','{$this->apellido}','{$this->email}',md5('{$this->pass}'));";
        $db->query($sql);
    }

    public static function eliminarUsuario($id) {
        $db = Database::getInstance();
        $db->query("DELETE FROM usuario WHERE idUsuario = $id;");
    }

    public function editar($id) {
        $db = Database::getInstance();
        $sql = "UPDATE `usuario` SET `nombreUsuario`='{$this->nombreUsuario}',`Apellido`='{$this->apellido}',`email`='{$this->email}',`rol`='{$this->rol}' WHERE idUsuario=$id";
        $db->query($sql);
    }

}
