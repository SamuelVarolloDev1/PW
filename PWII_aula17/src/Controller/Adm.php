<?php

namespace Etec\Samuel\Controller;
use Etec\Samuel\Model\BancoDeDados;
use Etec\Samuel\Model\Usuario;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Adm{
    private \Twig\Environment $ambiente;
    private \Twig\Loader\FilesystemLoader $carregador;
    public function __construct(){
        //Abre o diretório onde se encontram os templates
        $this->carregador = new \Twig\Loader\FilesystemLoader("./src/View");
        //Combina os dados com o template
        $this->ambiente = new \Twig\Environment($this->carregador);
    }

    function exibirFormularioDeCadastroDeUsuario(array $dados){
        //Renderiza o template de cadastro de usuário
        echo $this->ambiente->render("cadastroUsuario.html", $dados);
    }

    function cadastrarUsuario(array $dados){
        $u = new Usuario();
        $u->nome = $dados['nome'] ?? '';
        $u->senha = password_hash($dados['senha'] ?? '', PASSWORD_DEFAULT);
        $u->email = $dados['email'] ?? '';

        $bd = new BancoDeDados();
        $resultado = $bd->salvarUsuario($u);
    }
    
    function listarUsuarios(array $dados) {
        session_start();

        if(isset($_SESSION['id'])){
            //Pessoa logada
            echo "Uga <br> Caverna";
        }else{
            //Pessoa não logada
            echo "Acesso negado";
        }
    }

    function login(array $dados) {
        echo $this->ambiente->render("loginAdm.html", $dados);
    }

    function autenticar(array $dados){
        session_start();
        if(isset($dados['login']) && isset($dados['senha'])){
            //Aqui você faria a autenticação com o banco de dados, simulando uma autenticação bem-sucedida
            $_SESSION['id'] = 1; // ID do usuário autenticado
            $_SESSION['tipo'] = 'adm'; // Tipo de usuário
            //Nessa parte vamos usar o twig
            echo "Usuário autenticado com sucesso";
        }else{
            //Nessa parte vamos usar o twig
            echo "Usuário ou senha inválidos";
        }

    }
}