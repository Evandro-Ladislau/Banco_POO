<?php
require_once 'conexao.php';
require_once 'banco.php';

class Conta extends Banco {

    private $id;
    private $empresa_id;
    private $usuario_id;
    private $saldo;
    private $senha;
    private $cancelado;

    public function __construct($empresa_id, $usuario_id, $senha, $saldo)
    {
        $this->setEmpresa_id($empresa_id);
        $this->setUsuario_id($usuario_id);
        $this->setSenha($senha);
        $this->setSaldo($saldo);
        $this->setCancelado(false);

    }

    public function getEmpresa_id(){
        return $this->empresa_id;
    }

    public function setEmpresa_id($empresa_id){
        $this->empresa_id = $empresa_id;
    }

    public function getUsuario_id(){
        return $this->usuario_id;
    }
    
    public function setUsuario_id($usuario_id){
        $this->usuario_id = $usuario_id;
    }
    
    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getSaldo(){
        return $this->saldo;
    }

    public function setSaldo($saldo){
        $this->saldo = $saldo;
    }

    public function getCancelado(){
        return $this->cancelado;
    }

    public function setCancelado($cancelado){
        $this->cancelado = $cancelado;
    }

    public function BuscarContas($usuario_logado_id){

        $result = array();
        $this->conn = new Conexao();
        $stmt = $this->conn->pdo->prepare("SELECT * FROM conta WHERE usuario_id=:usuario_id AND cancelado=0");
        $stmt->bindValue(":usuario_id", $usuario_logado_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }else{
            return false;
        }
        
    }

    public function CadastrarConta(){

       $this->conn = new Conexao();
       $stmt = $this->conn->pdo->prepare('INSERT INTO conta (empresa_id, usuario_id, saldo, senha, cancelado)
                                     VALUES (:empresa_id, :usuario_id, :saldo, :senha, :cancelado) '
                                     );

        $stmt->bindValue(":empresa_id", $this->getEmpresa_id());
        $stmt->bindValue(":usuario_id", $this->getUsuario_id());
        $stmt->bindValue(":saldo",$this->getSaldo());
        $stmt->bindValue(":senha", $this->getSenha());
        $stmt->bindValue(":cancelado", $this->getCancelado());
        $stmt->execute();
        return true;

    }

    

    public function Depositar($deposito){
        if ($this->cancelado == true) {
            return "Por Favor, abra uma conta antes de fazer um depósito!"."<br>";
        }else{
            $this->saldo = $this->saldo + $deposito;
            return "Deposito Efetuado com Sucesso"."<br>";
        }
        
    }

    public function Sacar($saque){

        if ($this->cancelado == false) {
            
            if($this->saldo >= $saque){
                $this->saldo = $this->saldo - $saque;
                return "Saque Efetuado com Sucesso!"."<br>";
            }else{

                return "Você não tem saldo suficiente"."<br>";
            }

        }
    }

    public function FecharConta(){
        if (($this->cancelado == false) && ($this->saldo == 0)) {
            
            $this->cancelado = true;
            return "Conta cancelada com sucesso";
        }else{
            echo "Retire o dinheiro para efetuar o fechamento da conta"."<br>";
        }
    }

}
