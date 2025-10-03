<?php
// Variável de texto
$mensagem = "Olá mundo";
// Variável numérica
$idade = 15;
// Array vazio
$lista = array();
//Adiciona valores no array
$lista[] = "Teste1";
$lista[] = "Teste2";
$lista[] = "Teste3";
//Array não vazio
$lista2 = array("Teste1", "Teste2", "Teste3");
//Arrays numéricos
$lista3 = array();
$lista3[] = 1;
$lista3[] = 4;
$lista3[] = 5;
$lista3[] = 6;
$lista3[] = 90;
$lista3[] = 0.4;
//Acessar o valor
echo $lista3[0];
//Arrays com chave textual
$lista4 = array();
$lista4["RG"] = 454341344345;
$lista4["CPF"] = 4642524243523;
$lista4["Nome"] = "Samuel";
$lista4[] = "Caverna";
//Acessando valores
echo $lista4["RG"];
echo $lista4["CPF"];
//Array com chave numérica
$lista5 = array();
$lista5[2] = "Uga";
$lista5[0] = 10;
$lista5[20] = 45.6;
//Array não vazio
$lista6 = array("RG" => 6537839, "CPF" => 4378727574, "Nome" => "Uga", "Caverna");

for($i=0; $i < count($lista); $i++){
    echo $lista[$i];
}

foreach($lista6 as $chave => $valor){
    echo $chave;
    echo $valor;
}