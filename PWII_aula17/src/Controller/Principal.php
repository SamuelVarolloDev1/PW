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
        //Recupera o login e senha e retira os espaços desnecessários do fim e do início do que foi digitado
        $login = trim($dados['login']);
        $senha = trim($dados['senha']);

        if($login === "" || $senha === ""){
            header("redirect: /login");
        }

        if($login == "Pao" && $senha == "Farinha"){
            $dados["mensagem"] = "Login correto";
            /*Cria os cookies no navegador e no servidor caso uma sessão ainda não exista. 
            Caso a sessão já exista(login anterior já feito) session_start() recupera os dados da sessão anterior.
            E ATENÇÃO: Sempre que precisar ler ou gravar dados em uma sessão, é obrigatório usar session_start().*/
            session_start();
            /*A partir disso o php disponibiliza uma variável super global chamada $_SESSION dentro da qual colocaremos os dados da sessão.
            E ATENÇÃO: $_SESSION só fica disponível APÓS a execução de session_start();
            E mais: Evite colocar muitas informações na $_SESSION pois isso ocupa memória no servidor*/
            $_SESSION["id"] = 80;
            /*No código acima guardou-se o número 80 na posição "id" da sessão, 
            esse valor ficará salvo mesmo que o usuário saia do site e/ou recarregue a página.
            Curiosidade: Se você apagar os cookies do navegador você estará deslogando do site*/
            $dados["nome"] = "Banano de pijama"; 
            }

        echo $this->ambiente->render("autentica.html", $dados);
    }
}