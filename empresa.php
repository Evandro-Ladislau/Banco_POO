<?php

abstract class Empresa {
    
    
    private $conn;
    private $id;
    private $nome;
    private $cnpj;
    private $telefone;
    private $logradouro;
    private $ramo_atuacao;


    public function getConn(){
        return $this->conn;
    }

    public function setConn($conn){
        $this->conn = $conn;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getCnpj(){
        return $this->cnpj;
    }

    public function setCnpj($cnpj){
        $this->cnpj = $cnpj;
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

    public function getRamo_Atuacao(){
        return $this->ramo_atuacao;
    }
    
    public function setRamo_Atuacao($ramo_atuacao){
        $this->ramo_atuacao = $ramo_atuacao;
    }

    function BuscarCnpj($cnpj){

    }

    public function CadastrarEmpresa(){

    }
}