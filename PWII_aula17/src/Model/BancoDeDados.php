<?php
namespace Etec\Samuel\Model;

class BancoDeDados{
    private \PDO $conexao;

    public function __construct(){
        $this->conexao = new \PDO("mysql:host=localhost;dbname=dbSistema", "root", "");
    }

    public function recuperarUsuario(int $id) : ?USUARIO{
        //Prepara a instrução SQL para buscar o usuário pelo ID
        $stmt = $this->conexao->prepare("SELECT id, nome, email, senha FROM Usuario WHERE id = :id");

        $stmt->bindValue(":id", $id);
        $stmt->execute();

        //Busca resultado e cria um objeto Usuario caso seja encontrado
        $resultado = $stmt->fetchObject(Usuario::class);

        if($resultado != null){
            //Retorna o objeto Usuario encontrado
            return $resultado;
        }else{
            //Retorna null se não encontrar o Usuario
            return null;
        }
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