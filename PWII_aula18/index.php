<?php
require "vendor/autoload.php";

const URL = "http://localhost";

// Cria o roteador
$roteador = new CoffeeCode\Router\Router(URL);

// Informa o namespace onde os controladores se encontram
$roteador->namespace("Etec\TurmaAB\Controller");

// === Área pública ===
$roteador->group(null);
$roteador->get("/", "Principal:paginaPrincipal");
$roteador->get("/sobre", "Principal:sobre");

// === Área de login ===
$roteador->get('/formularioNovoLogin', "Login:formularioNovoLogin");
// Exibe o formulário de login
$roteador->get('/login', "Login:formularioLogin");
// Autentica o usuário
$roteador->post('/login', "Login:autenticar");
$roteador->post('/salvaLogin', "Login:salvaLogin");
$roteador->get('/logout', "Login:logout");

// === Tarefas administrativas ===
$roteador->group("admin");

// === Área de produtos ===
$roteador->get('/produtos', "Admin:listaProdutos");

// Mostra o formulário de cadastro de produtos
$roteador->get('/formularioNovoProduto', "Admin:formularioNovoProduto");

// Rota para salvar o novo produto
$roteador->post('/salvaProduto', "Admin:salvaProduto");

$roteador->dispatch();

