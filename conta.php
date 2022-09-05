<?php
require_once 'conexao.php';
require_once 'banco.php';

class Conta extends Banco {

    private $id;
    private $empresa_id;
    private $usuario_id;
    private $saldo;
    private $transacao_id;
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

    public function getTransacao_id(){
        return $this->transacao_id;
    }

    public function setTransacao_id($transacao_id){
        $this->transacao_id = $transacao_id;
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
        $stmt = $this->conn->pdo->prepare("SELECT c_user.saldo, c_user.created hora, tran_user.nome tram_nome
        FROM conta c_user
        INNER JOIN transacao tran_user ON tran_user.id=c_user.transacao_id
        WHERE c_user.usuario_id=:usuario_id AND c_user.cancelado=0");
        $stmt->bindValue(":usuario_id", $usuario_logado_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }else{
            return false;
        }
        
    }

    public function BuscarHistoricoMovimentacao($usuario_logado_id){

        $result = array();
        $this->conn = new Conexao();
        $stmt = $this->conn->pdo->prepare("SELECT mov.valor, mov.created, tran_user.nome 
        FROM movimentacao mov 
        INNER JOIN  transacao tran_user ON tran_user.id=mov.transacao_id
        WHERE usuario_id=:usuario_id AND mov.cancelado=0");
        $stmt->bindValue(":usuario_id", $usuario_logado_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }else{
            return false;
        }
    }

    public function CadastrarConta($transacao_id){

       $this->conn = new Conexao();
       $stmt = $this->conn->pdo->prepare('INSERT INTO conta (empresa_id, usuario_id, saldo, transacao_id, senha, cancelado, created)
                                     VALUES (:empresa_id, :usuario_id, :saldo, :transacao_id , :senha, :cancelado, NOW()) '
                                     );

        $stmt->bindValue(":empresa_id", $this->getEmpresa_id());
        $stmt->bindValue(":usuario_id", $this->getUsuario_id());
        $stmt->bindValue(":saldo",$this->getSaldo());
        $stmt->bindValue(":transacao_id", $transacao_id);
        $stmt->bindValue(":senha", $this->getSenha());
        $stmt->bindValue(":cancelado", $this->getCancelado());
        $stmt->execute();
        return true;

    }

    public function HistoricoMovimentacao($transacao_id, $transacao_valor){

        $this->conn = new Conexao();
        $stmt = $this->conn->pdo->prepare('INSERT INTO movimentacao (empresa_id, usuario_id, transacao_id, valor, senha, cancelado, created)
                                      VALUES (:empresa_id, :usuario_id, :transacao_id, :valor, :senha, :cancelado, NOW()) '
                                      );
 
         $stmt->bindValue(":empresa_id", $this->getEmpresa_id());
         $stmt->bindValue(":usuario_id", $this->getUsuario_id());
         $stmt->bindValue(":transacao_id", $transacao_id);
         $stmt->bindValue(":valor",$transacao_valor);
         $stmt->bindValue(":senha", $this->getSenha());
         $stmt->bindValue(":cancelado", $this->getCancelado());
         $stmt->execute();
         return true;
 
     }


    public function Depositar($deposito){
        if ($this->cancelado == 1) {
            return "Por Favor, abra uma conta antes de fazer um depósito!"."<br>";
        }else{
            
            $this->setSaldo($this->getSaldo() + $deposito);
            return "Valor R$". number_format($deposito, 2, ',', ' ') . " Depositado com sucesso!";
        }
        
    }

    public function Sacar($saque){

        if ($this->cancelado == 0) {
            
            if($this->saldo >= $saque){
                $this->setSaldo($this->getSaldo() - $saque);
                return true;
            }else{

                return false;
            }

        }
    }

    public function FecharConta($usuario_id){
        if (($this->cancelado == 0) && ($this->saldo == 0)) {
            
            $this->cancelado = 1;

        $this->conn = new Conexao();
        $stmt = $this->conn->pdo->prepare('UPDATE conta SET cancelado=1 WHERE usuario_id=:usuario_id');
        $stmt->bindValue(':usuario_id', $usuario_id);
        $stmt->execute();
        return true;

        }else{
            return false;
        }
    }

}
