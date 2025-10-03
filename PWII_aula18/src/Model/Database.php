<?php
namespace Etec\TurmaAB\Model;

class Database
{
    private \PDO $conexao;

    public function __construct()
    {
        $this->conexao = new \PDO("mysql:host=localhost;dbname=dbSistema", "root", "");
    }

    function loadUser(int $id): ?User
    {
        // Prepara a instrução SQL para buscar o usuário pelo ID
        $stmt = $this->conexao->prepare("SELECT id, nome, email, senha FROM User WHERE id = :id");

        $stmt->bindValue(":id", $id);
        $stmt->execute();

        // Busca o resultado e cria um objeto User caso seja encontrado
        $resultado = $stmt->fetchObject(User::class);

        if ($resultado) {
            return $resultado; // Retorna o objeto User encontrado
        }

        // Retorna null se não encontrar o usuário
        return null;
    }

    function loadUserByEmailAndSenha(string $email, string $senha): ?User
    {
        $stmt = $this->conexao->prepare("SELECT id, nome, email, senha FROM User WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        $usuario = $stmt->fetchObject(User::class);
        if ($usuario && password_verify($senha, $usuario->senha)) {
            return $usuario;
        }

        return null;
    }

    function saveUser(User $user): bool
    {
        // Acessa a propriedade "conexao" do objeto
        // ($this->conexao) e prepara a instrução SQL
        // para ser executada
        $stmt = $this->conexao->prepare("INSERT INTO User (nome, email, senha) VALUES (:nome, :email, :senha)");

        // Substitui os "placeholders" pelos seus
        // respectivos valores
        $stmt->bindValue(":nome", $user->nome);
        $stmt->bindValue(":email", $user->email);
        $stmt->bindValue(":senha", $user->senha);

        // Executa o sql no banco
        return $stmt->execute();
    }

    function saveProduto(Produto $produto): bool
    {
        $stmt = $this->conexao->prepare("INSERT INTO Produto ( nome, valor) VALUES (:nome, :valor)");

        $stmt->bindValue(":nome", $produto->nome);
        $stmt->bindValue(":valor", $produto->valor);

        return $stmt->execute();
    }

    public function loadProduto(int $id): ?Produto
    {
        $stmt = $this->conexao->prepare("SELECT id, nome, valor FROM Produto WHERE id = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        return $stmt->fetchObject(Produto::class) ?: null;
    }

    public function loadProdutos(): array
    {
        $stmt = $this->conexao->prepare("SELECT id, nome, valor FROM Produto");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, Produto::class);
    }

}