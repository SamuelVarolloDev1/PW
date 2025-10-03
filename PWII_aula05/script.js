document.addEventListener("DOMContentLoaded", () => 
{
    async function autenticarLogineSenha()
    {

        const Login = document.getElementById("login").value;
        const Senha = document.getElementById("senha").value;

        try{
            const resposta = await fetch("http://localhost/PWII_aula05/servico.php");
        
            if(!resposta.ok)
            {
                throw new Error("O servidor não respondeu corretamente");
            }

            const resultado = await resposta.text();
            if(Login + Senha == resultado)
                {
                    window.location.href = "calculadora.html";
                }else{
                    alert("Login ou senha incorretos");
                }
            
        }catch(erro)
        {
            console.error("Erro ao carregar as informações:", erro);
        }
    }

    const botao = document.getElementById("botao");
    botao.addEventListener("click", () => 
        {
            autenticarLogineSenha();
        });
    
});