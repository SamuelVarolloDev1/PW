<?php
namespace Etec\Samuel\Controller;

class Principal {
    private \Twig\Environment $ambiente;

    public function __construct() {
        $carregador = new \Twig\Loader\FilesystemLoader("./src/View");
        $this->ambiente = new \Twig\Environment($carregador);
        session_start();
    }

    public function index(): void {
        if (isset($_SESSION['login'])) {
            header("Location: /main");
            exit();
        }

        echo $this->ambiente->render("index.html");
    }

    public function login(array $dados): void {
        $login = trim($dados['login'] ?? '');
        $senha = trim($dados['senha'] ?? '');

        if ($login === "Usuário" && $senha === "123") {
            $_SESSION['login'] = $login;
            header("Location: /main");
            exit();
        } else {
            echo "Login ou senha inválidos.";
        }
    }

    public function main(): void {
        if (!isset($_SESSION['login'])) {
            header("Location: /");
            exit();
        }

        echo $this->ambiente->render("main.html", [
            "usuario" => $_SESSION['login']
        ]);
    }
}
