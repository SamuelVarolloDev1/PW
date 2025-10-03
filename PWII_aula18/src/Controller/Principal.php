<?php
namespace Etec\TurmaAB\Controller;

use Etec\TurmaAB\Model\Database;
use Etec\TurmaAB\Model\User;

class Principal
{
    private \Twig\Environment $ambiente;
    private \Twig\Loader\FilesystemLoader $carregador;

    public function __construct()
    {
        // Construtor da classe
        $this->carregador =
            new \Twig\Loader\FilesystemLoader("./src/View");

        // Combina os dados com o template
        $this->ambiente =
            new \Twig\Environment($this->carregador);
    }


    public function paginaPrincipal(array $dados)
    {
        $dados["titulo"] = "Página Principal";
        $dados["conteudo"] = "Bem-vindo à página principal!";

        // Renderiza a view principal
        echo $this->ambiente->render("principal.html", $dados);
    }

    public function sobre(array $dados)
    {
        $dados["titulo"] = "Sobre";
        $dados["conteudo"] = "Somos uma empresa cuja missão é sugar até o talo nossos funcionários e clientes!";

        // Renderiza a view sobre
        echo $this->ambiente->render("sobre.html", $dados);
    }

}

