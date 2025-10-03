<?php
class Animal{
    public int $Peso;
    public int $Altura;

    protected string $QuimicaDoSangue;

    protected function ProduzirInsulina(){
        return "Insulina";
    }

    public function Locomover(){
        echo "Pela estrada afora, eu vou bem...";
    }

    public function Comer(){
        echo "Chomp Chomp";
    }
}

// $Scoob = new Animal();
// $Scoob->Altura = 80;
// $Scoob->Peso = 50;
// $Scoob->Comer();
// $Scoob->Locomover();

// $Jorge = new Animal();
// $Jorge->Altura = 180;
// $Jorge->Peso = 100;
// $Jorge->Comer();
// $Jorge->Locomover();

/*Quando uma classe extende a outra, 
isso significa que a classe herda tudo o que é público e protegido da outra classe.
Métodos e propriedades privados NÃO PODEM ser herdados*/
class Cachorro extends Animal{
    /*Aqui eu sobrescrevo o metódo "Locomover", 
    pois necessito que este método se comporte diferentemente do original*/
    public function Locomover(){
        echo "Au, Au... Sniff, Sniff...";
    }
}

class Humano extends Animal{
    public function Comer(){
        echo "Mastiga com classe";
    }
    
    public function Falar(string $palavras){
        echo $palavras;
    }
}

$Cobra = new Animal();
$Cobra->Altura = 30;
$Cobra->Peso = 100;
$Cobra->Locomover();
$Cobra->Comer();

$Thor = new Cachorro();
$Thor->Locomover();
$Thor->Comer();

$Juliana = new Humano();
$Juliana->Falar("AWWW, que cachorro bonitinho!!!");
$Juliana->Locomover();