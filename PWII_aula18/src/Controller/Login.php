<?php

namespace Etec\TurmaAB\Controller;

use Etec\TurmaAB\Model\Database;
use Etec\TurmaAB\Model\User;

class Login
{
    private \Twig\Environment $ambiente;
    private \Twig\Loader\FilesystemLoader $carregador;

    public function __construct()
    {
        // Inicia a sessão
        session_start();

        // Configura o carregador e o ambiente do Twig
        $this->carregador = new \Twig\Loader\FilesystemLoader("./src/View");
        $this->ambiente = new \Twig\Environment($this->carregador);
    }

    /**
     * Exibe o formulário de login
     * @param array $dados
     * @return void
     */
    public function formularioLogin(array $dados)
    {
        echo $this->ambiente->render("formularioLogin.html", $dados);
    }

    /**
     * Autentica o usuário
     * @param array $dados
     * @return void
     */
    function autenticar(array $dados)
    {
        $email = trim($dados["email"]);
        $senha = $dados["senha"];

        $avisos = "";

        if ($email == "" || $senha == "") {
            $avisos .= "Preencha todos os campos.";
        } else {
            $bd = new Database();
            $usuario = $bd->loadUserByEmailAndSenha($email, $senha);
            if ($usuario) {
                $_SESSION["usuario"] = $usuario;
                header("Location: /");
                exit;
            } else {
                $avisos .= "Email ou senha inválidos.";
            }
        }

        $dados["avisos"] = $avisos;
        echo $this->ambiente->render("formularioLogin.html", $dados);
    }


    /**
     * Exibe o formulário para criação de um novo login
     * @param array $dados
     * @return void
     */
    public function formularioNovoLogin(array $dados)
    {
        echo $this->ambiente->render("formularioNovoLogin.html", $dados);
    }

    /**
     * Salva um novo login
     * @param array $dados
     * @return void
     */
    public function salvaLogin(array $dados)
    {
        $nome = trim($dados["nome"]);
        $email = trim($dados["email"]);
        $senha = $dados["senha"];

        $avisos = "";

        if ($nome == "" || $email == "" || $senha == "") {
            $avisos .= "Preencha todos os campos.";
        } else {
            $usuarie = new User();
            $usuarie->nome = $nome;
            $usuarie->email = $email;
            $usuarie->senha = password_hash($senha, PASSWORD_DEFAULT);

            $bd = new Database();
            if ($bd->saveUser($usuarie)) {
                // Avisa que deu certo
                $avisos .= "Usuário cadastrado com sucesso.";
            } else {
                // Avisa que deu errado
                $avisos .= "Erro ao cadastrar usuário.";
            }
        }

        $dados["avisos"] = $avisos;
        echo $this->ambiente->render("formularioNovoLogin.html", $dados);
    }

    public function logout(array $dados)
    {
        // Inicia a sessão
        session_start();

        // Remove o usuário da sessão
        unset($_SESSION["usuario"]);

        // Redireciona para a página principal
        header("Location: /");
        exit;
    }

}