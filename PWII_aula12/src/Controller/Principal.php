<?php
namespace Etec\Samuel\Controller;

class Principal{
    /*A classe Environment serve como gerenciadora dos dados que vem do template e do controlador.
    O papel dele é combinar os dados e gerar o HTML final*/
    private \Twig\Environment $ambiente;
    /*O carregador tem a função de ler o template de alguma origem.
    Neste caso carregaremos o template do sistema de arquivos(ou seja, disco ou armazenamento local)*/
    private \Twig\Loader\FilesystemLoader $carregador;

    public function __construct(){
        //Abre o diretório onde se encontram os templates
        $this->carregador = new \Twig\Loader\FilesystemLoader("./src/View");
        //Combina os dados com o template
        $this->ambiente = new \Twig\Environment($this->carregador);
    }

    public function inicio(array $dados){
        $dados["titulo"] = "Página inicial";
        $dados["mensagem"] = "Olá";
        //Exibe a página construída
        echo $this->ambiente->render("inicio.html", $dados);
    }
    public function sobre(array $dados){
        $dados["mensagem"] = "Eu tento escutar o que eles dizem, mas eles não dizem nada";
        echo $this->ambiente->render("sobre.html", $dados);
    }
    public function login(array $dados){
        $dados["mensagem"] = "Informe seu login e senha";
        echo $this->ambiente->render("login.html", $dados);
    }
    public function autenticar(array $dados){
        echo $this->ambiente->render("autentica.html", $dados);
    }
}