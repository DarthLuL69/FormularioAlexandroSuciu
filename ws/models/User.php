<?php
require_once '../interfaces/IToJson.php';

class User implements IToJson {
    private $nombre;
    private $apellidos;
    private $password;
    private $telefono;
    private $email;
    private $sexo;

    public function __construct($nombre, $apellidos, $password, $telefono, $email, $sexo) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->password = $password;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->sexo = $sexo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function toJson() {
        return json_encode(get_object_vars($this));
    }
}
?>