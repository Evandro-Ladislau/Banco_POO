<?php
require_once 'empresa.php';
require_once 'conexao.php';

class Banco extends Empresa {
    
    public function __construct($nome, $cnpj, $telefone, $logradouro, $ramo_atuacao)
    {
        $this->setNome($nome);
        $this->setCnpj($cnpj);
        $this->setRamo_atuacao($ramo_atuacao);
        $this->setTelefone($telefone);
        $this->setLogradouro($logradouro);
    }

    function BuscarCnpj($cnpj){

        if (!empty($cnpj)) {    
            $this->conn = new Conexao();
            $result = array();
            $stmt = $this->conn->pdo->prepare('SELECT cnpj FROM empresa WHERE cnpj=:cnpj');
            $stmt->bindValue(':cnpj', $cnpj);
            $stmt->execute();
            if($stmt->rowCount() > 0){
    
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }else{
                return false;
            }
            }
    }


    function CadastrarEmpresa(){

        $this->conn = new Conexao();
        $stmt = $this->conn->pdo->prepare("INSERT INTO 
        empresa (nome, cnpj, ramo_atuacao, telefone, logradouro)
        VALUES (:nome, :cnpj, :ramo_atuacao, :telefone, :logradouro)");
        $stmt->bindValue(':nome', $this->getNome());
        $stmt->bindValue(':cnpj', $this->getCnpj());
        $stmt->bindValue(':ramo_atuacao', $this->getRamo_atuacao());
        $stmt->bindValue(':telefone', $this->getTelefone());
        $stmt->bindValue(':logradouro', $this->getLogradouro());
        $stmt->execute();
        return true;


    }

    
    
}