"use strict";

function nomeDoMes(IntNumeroDoMes)
{
    IntNumeroDoMes -= 1;
    let StrMeses = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];

    if (StrMeses[IntNumeroDoMes])
    {
        return StrMeses[IntNumeroDoMes];
    }
    else
    {
        throw "Mês inválido";
    }
}

function ExibirMes(IntNumeroDoMes)
{
    try 
    {
        let StrNome = nomeDoMes(IntNumeroDoMes);
        alert(StrNome);    
    } 
    catch (error) 
    {
        alert(error);    
    }
}

teste 
ExibirMes(0);
ExibirMes(1);
ExibirMes(103);

function ValidarNome()
{
    let StrCampoForm = document.getElementById("txtNome");

    if (StrCampoForm.value.trim() === "")
    {
        alert("campo vazio");
    }
}