<?php
require_once 'vendor/autoload.php';

const URL = "http://localhost";

//Cria o roteador
$roteador = new CoffeeCode\Router\Router(URL);

$roteador->namespace("Etec\Samuel\Controller");

//Rota principal
$roteador->group(null);
$roteador->get("/","Principal:index");
$roteador->post("/login","Principal:login");
$roteador->get("/main","Principal:main");


$roteador->dispatch();