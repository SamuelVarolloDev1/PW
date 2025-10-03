document.addEventListener("DOMContentLoaded", () => 
{
    const button = document.getElementById("btnAcessar");
    const inputField = document.getElementById("txtValor");

    async function carregarInformacao()
    {
        try{
            const resposta = await fetch("http://localhost/PWII_aula04/servico.php");
        
            if(!resposta.ok)
            {
                throw new Error("O servidor não respondeu corretamente");
            }

            const resultado = await resposta.text();
            inputField.value = resultado;
        }catch(erro)
        {
            console.error("Erro ao carregar as informações:", error);
        }
    }

    button.addEventListener("click", () => 
    {
        //Executa de forma assíncrona
        carregarInformacao();

        //Executa mesmo que "carregarInformacao" ainda não tenha terminado
        alert("teste");
    });
}
);