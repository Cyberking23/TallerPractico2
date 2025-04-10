<?php

class Users {
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $rol_id; // Nuevo atributo para el rol
    public $db; 

    public function __construct($db, $id = null, $nombre = null, $email = null, $password = null, $rol_id = null) {
        $this->db = $db->getConnection();  // Obtener la conexión desde el método getConnection()
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->rol_id = $rol_id;
    }

    public function Login() {
        try {
            $query = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar si el usuario existe y comparar contraseñas en texto plano
            if ($user && $this->password === $user['password']) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                $_SESSION['user_role'] = $user['rol_id']; // Guardamos el rol en sesión
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
            $query = "SELECT id, nombre, email, rol_id FROM usuarios WHERE id = :id";
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
            $query = "UPDATE usuarios SET nombre = :nombre, email = :email, password = :password WHERE id = :id";
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
            $query = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute(); 
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function register() {
        try {
            $query = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si ya existe, retornar un error
            if ($user) {
                return "El correo electrónico ya está registrado.";
            }

            // Si no existe, insertar el nuevo usuario
            $query = "INSERT INTO usuarios (nombre, email, password, rol_id) VALUES (:nombre, :email, :password, :rol_id)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':email', $this->email);
            // Encriptar la contraseña antes de guardarla
            $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->bindParam(':rol_id', $this->rol_id); // Asignar el rol al usuario

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "Usuario registrado con éxito.";
            } else {
                return "Error al registrar el usuario.";
            }
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}

?>
