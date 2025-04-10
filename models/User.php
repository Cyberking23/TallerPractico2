<?php

class Users {
    private $id;
    private $nombre;
    private $email;
    private $password; // In a real application, this should be hashed

    public function __construct($id, $nombre, $email, $password) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
    }

    public function Login($email, $password) {

        return ($this->email === $email && $this->password === $password);
    }

    public function getUserInfo() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'password' => $this->password 
        ];
    }

    public function updateUser($nombre = null, $email = null, $password = null) {
        if ($nombre !== null) {
            $this->nombre = $nombre;
        }
        if ($email !== null) {
            $this->email = $email;
        }
        if ($password !== null) {
            $this->password = $password;
        }
    }

    public function deleteUser() {

        echo "Usuario con ID {$this->id} eliminado.\n";
    }
}

?>