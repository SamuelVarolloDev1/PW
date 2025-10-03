<?php
require_once 'vendor/autoload.php';

const URL = "http://localhost/PWII_aula13";

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
$roteador->get("/login","Admin:login");
$roteador->get("/produtos","Admin:produtos");

$roteador->dispatch();