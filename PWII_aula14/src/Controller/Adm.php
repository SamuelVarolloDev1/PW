<?php

namespace Etec\Samuel\Controller;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Adm{
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
}