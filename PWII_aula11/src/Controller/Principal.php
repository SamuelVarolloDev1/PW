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
        //Lógica da página
        //Integração com o Twig 
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
}