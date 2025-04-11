<?php

class Users {
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $rol; // Nuevo atributo para el rol
    public $id_escuela; // Relación opcional con escuela

    // Constructor que acepta un array asociativo
    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->rol = $data['rol'] ?? null;
        $this->id_escuela = $data['id_escuela'] ?? null;
    }

    public function Login() {
        try {
            $query = "SELECT * FROM users WHERE email = '{$this->email}'";
            $result = Conexion::query($query); // Retorna un array asociativo directamente
            
            // Verificar si el usuario existe y comparar contraseñas
            if ($result && password_verify($this->password, $result['password'])) {
                session_start();
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_name'] = $result['nombre'];
                $_SESSION['user_role'] = $result['rol']; // Guardamos el rol en sesión
                $_SESSION['user_escuela'] = $result['id_escuela']; // Guardamos la escuela en sesión
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
            $query = "SELECT id, nombre, email, rol, id_escuela FROM users WHERE id = '{$this->id}'";
            $result = Conexion::query($query); // Retorna un array asociativo directamente
            return $result ?? null; // Retorna el resultado o null si no hay datos
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function updateUser() {
        try {
            $query = "UPDATE users SET 
                        nombre = '{$this->nombre}', 
                        email = '{$this->email}', 
                        password = '{$this->password}', 
                        id_escuela = '{$this->id_escuela}' 
                      WHERE id = '{$this->id}'";
            Conexion::query($query);
            return true; // Devuelve true si la actualización es exitosa
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function deleteUser() {
        try {
            $query = "DELETE FROM users WHERE id = '{$this->id}'";
            Conexion::query($query);
            return true; // Devuelve true si la eliminación es exitosa
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function register() {
        try {
            $query = "SELECT * FROM users WHERE email = '{$this->email}'";
            $result = Conexion::query($query); // Retorna un array asociativo directamente

            // Si ya existe, retornar un error
            if ($result) {
                return ["error" => "El correo electrónico ya está registrado."];
            }

            // Si no existe, insertar el nuevo usuario
            $query = "INSERT INTO users (nombre, email, password, id_escuela) 
                      VALUES ('{$this->nombre}', '{$this->email}', '{$this->password}', '{$this->id_escuela}')";
           
            var_dump($query);
           Conexion::query($query);

            return ["success" => "Usuario registrado exitosamente."];
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}

?>
