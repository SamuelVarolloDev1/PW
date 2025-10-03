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

/*Uma interface é um padrão que define quais métodos uma classe deve implementar.
Uma interface não pode ter métodos implementados e não pode ter propriedades.
Uma interface não pode ser instaciada*/ 
interface IAutentica{
    public function autenticar(string $Senha): bool;
    public function desautenticar(): void;
    public function estaAutenticado(): bool;
}

function Autentica(IAutentica $ModuloDeAutenticacao, string $Senha){
    if($ModuloDeAutenticacao->estaAutenticado()){
        return;
    }

    if($ModuloDeAutenticacao->autenticar($Senha)){
        echo "Usuário autenticado com sucesso!";
    }else{
        echo "Senha inválida!";
    }
} 

// class AutenticacaoComAuAu implements IAutentica{

//     private bool $Autenticado = false;

//     public function autenticar(string $Senha): bool{
//         if($Senha === "AuAu"){
//             $this->Autenticado = true;
//         }else{
//             $this->Autenticado = false;
//         }  
//         return $this->Autenticado;
//     }
    
//     public function desautenticar(): void{
//         $this->Autenticado = false;
//         echo "Desautenticado com sucesso";
//     }

//     public function estaAutenticado(): bool{
//         return $this->Autenticado;
//     }
// }

// $Autenticador = new AutenticacaoComAuAu();
// Autentica($Autenticador, "Uga");
// Autentica($Autenticador, "AuAu");

class AutenticacaoComOla implements IAutentica{

    private bool $Autenticado = false;

    public function autenticar(string $Senha): bool{
        return $this->Autenticado = ($Senha === "Ola");
    }
    
    public function desautenticar(): void{
        $this->Autenticado = false;
        echo "Não foi autenticado";
    }

    public function estaAutenticado(): bool{
        return $this->Autenticado;
    }
}

$Aut2 = new AutenticacaoComOla();
Autentica($Aut2, "Ola");