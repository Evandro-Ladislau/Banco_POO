<?php



abstract class Pessoa {

    #conexão
    private $conn;
    
    # Dados Pessoais
    private $id;
    private $nome;
    private $email;
    private $telefone;

    #Localização
    private $logradouro;
    private $numero;
    private $cidade;
    private $bairro;
    private $cep;

    #autenticação
    public $senha;
	private $conf_senha;

    public function getConn(){
        return $this->conn;
    }
    
    public function setConn($conn){
        $this->conn = $conn;
    }

    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getEmail(){
        return $this->email;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }

    public function getTelefone(){
        return $this->telefone;
    }
    
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getLogradouro(){
        return $this->logradouro;
    }
    
    public function setLogradouro($logradouro){
        $this->logradouro = $logradouro;
    }

    public function getNumero(){
        return $this->numero;
    }
    
    public function setNumero($numero){
        $this->numero = $numero;
    }

    public function getCidade(){
        return $this->cidade;
    }
    
    public function setCidade($cidade){
        $this->cidade = $cidade;
    }

    public function getBairro(){
        return $this->bairro;
    }
    
    public function setBairro($bairro){
        $this->bairro = $bairro;
    }

    public function getCep(){
        return $this->cep;
    }
    
    public function setCep($cep){
        $this->cep = $cep;
    }

    public function getSenha(){
        return $this->senha;
    }
    
    public function setSenha($senha){
       $this->senha = $senha;
    
    }

    public function getConf_senha(){
        return $this->conf_senha;
    }
    
    public function setConf_senha($conf_senha){
       $this->conf_senha = $conf_senha;
    
    }

    public function CadastrarUsuario(){

    }

    public function BuscarEmail($email){

    }
    
    

}


