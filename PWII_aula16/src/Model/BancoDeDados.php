<?php
namespace Etec\Samuel\Model;

class BancoDeDados{
    private \PDO $conexao;

    public function __construct(){
        $this->conexao = new \PDO("mysql:host=localhost;dbname=dbSistema", "root", "");
    }

    public function salvarUsuario(Usuario $u){
        //Guarda o SQL preparado
        $stmt = $this->conexao->prepare("INSERT INTO Usuario(login, senha) VALUES (:login, :senha)");

        //Vincula os placeholders com os valores
        $stmt->bindValue(":login", $u->login);
        $stmt->bindValue(":senha", $u->senha);

        //Executa o SQL
        return $stmt->execute();
    }
}