<?php
require_once 'pessoa.php';
require_once 'conexao.php';

class Usuario extends Pessoa {

    public function __construct($nome, $email, $telefone, $logradouro, $numero, $cidade, 
                                    $bairro, $cep, $senha, $conf_senha)
    {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setTelefone($telefone);
        $this->setLogradouro($logradouro);
        $this->setNumero($numero);
        $this->setCidade($cidade);
        $this->setBairro($bairro);
        $this->setCep($cep);
        $this->setSenha($senha);
        $this->setconf_senha($conf_senha);
    }

    
    function BuscarEmail($email){
        
        if (!empty($email)) {    
        $this->conn = new Conexao();
        $result = array();
        $stmt = $this->conn->pdo->prepare('SELECT email FROM usuario WHERE email=:email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        if($stmt->rowCount() > 0){

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }else{
            return false;
        }
        }
    }

    
    function CadastrarUsuario(){
        
        $this->conn = new Conexao();
        $stmt = $this->conn->pdo->prepare("INSERT INTO 
        usuario (nome, email, telefone, logradouro, numero, cidade, bairro, cep, senha, conf_senha)
        VALUES (:nome, :email, :telefone, :logradouro, :numero, :cidade, :bairro, :cep, :senha, :conf_senha)");
        $stmt->bindValue(':nome', $this->getNome());
        $stmt->bindValue(':email', $this->getEmail());
        $stmt->bindValue(':telefone', $this->getTelefone());
        $stmt->bindValue(':logradouro', $this->getLogradouro());
        $stmt->bindValue(':numero', $this->getNumero());
        $stmt->bindValue(':cidade', $this->getCidade());
        $stmt->bindValue(':bairro', $this->getBairro());
        $stmt->bindValue(':cep', $this->getCep());
        $stmt->bindValue(':senha', $this->getSenha());
        $stmt->bindValue(':conf_senha', $this->getConf_senha());
        $stmt->execute();
        return 'Cadastrado com sucesso!';
        }


        public function AcessarConta($usuario_id)
        {
            $result = array();
            $this->conn = new Conexao();
            $stmt = $this->conn->pdo->prepare("SELECT * FROM conta WHERE usuario_id=:usuario_id ");
            $stmt->bindValue(":usuario_id", $usuario_id);
            $stmt->execute();
            if($stmt->rowCount() > 0){

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
        }else{

            return false;
        }
    }
    
}
