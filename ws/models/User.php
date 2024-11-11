<?php

require_once '../interfaces/IToJson.php';

class Usuario implements IToJson {
    private $conn;
    private $table_name = "alumno";

    public $id;
    public $nombre;
    public $apellidos;
    public $password;
    public $telefono;
    public $email;
    public $sexo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUsuario($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsuarios() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUsuario() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, apellidos=:apellidos, password=:password, telefono=:telefono, email=:email, sexo=:sexo";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellidos", $this->apellidos);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":sexo", $this->sexo);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }

        return false;
    }

    public function updateUsuario($id) {
        $query = "UPDATE " . $this->table_name . " SET nombre=:nombre, apellidos=:apellidos, password=:password, telefono=:telefono, email=:email, sexo=:sexo WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellidos", $this->apellidos);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":sexo", $this->sexo);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function deleteUsuario($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        return $stmt->execute();
    }

    public function toJson() {
        return json_encode(get_object_vars($this));
    }
}
?>