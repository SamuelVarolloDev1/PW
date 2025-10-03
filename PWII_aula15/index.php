<?php
require_once 'vendor/autoload.php';

const URL = "http://localhost";

//Cria o roteador
$roteador = new CoffeeCode\Router\Router(URL);

$roteador->namespace("Etec\Samuel\Controller");

//Rota principal
$roteador->group(null);
$roteador->get("/","Principal:inicio");
$roteador->get("/sobre","Principal:sobre");
$roteador->get("/login","Principal:login");
$roteador->post("/login","Principal:autenticar");

$roteador->group("admin");
$roteador->get("/lista","Adm:listarUsuarios");
$roteador->get("/login","Adm:login");
//Processador do login
$roteador->post("/login","Adm:autenticar");
$roteador->get("/produtos","Adm:produtos");

$roteador->dispatch();