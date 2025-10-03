<?php
require_once 'vendor/autoload.php';

const URL = "http://localhost/PWII_aula11";

//Cria o roteador
$roteador = new CoffeeCode\Router\Router(URL);

$roteador->namespace("Etec\Samuel\Controller");

//Rota principal
$roteador->group(null);
$roteador->get("/","Principal:inicio");

$roteador->dispatch();