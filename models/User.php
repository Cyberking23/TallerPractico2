<?php

class Users {
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $db; 

    public function __construct($db, $id = null, $nombre = null, $email = null, $password = null) {
        $this->db = $db;  // Conexión a la base de datos
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
    }

    public function Login() {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($this->password, $user['password'])) {
                // Sesión activa
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                return true; // Login exitoso
            } else {
                return false; // Credenciales incorrectas
            }
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getUserInfo() {
        try {
            $query = "SELECT id, nombre, email FROM users WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function updateUser() {
        try {
            $query = "UPDATE users SET nombre = :nombre, email = :email, password = :password WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', password_hash($this->password, PASSWORD_DEFAULT)); // Hashed password
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute(); // Devuelve true si la actualización es exitosa
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function deleteUser() {
        try {
            $query = "DELETE FROM users WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute(); 
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}

?>
