<?php

class Conexao {

    public $pdo;

     function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=banco', 'root', '');
            $this->pdo->exec("SET CHARACTER SET utf8");

        } catch (\Throwable $th) {
            return $th;
        }

        return $this->pdo;
        
    }

    public function LogarUsuario($email){
        
        $resul = array();
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email=:email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function BuscarEmpresa(){

        $result = array();
        $stmt = $this->pdo->prepare("SELECT * FROM empresa");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function BuscarTransacao(){

        $result = array();
        $stmt = $this->pdo->prepare("SELECT * FROM transacao WHERE id <= 2");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
   
}


