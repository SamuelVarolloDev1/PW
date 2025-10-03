let lista = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
let contador = 0;

for(let i = 0; i < lista.length; i++){
    const elemento = lista[i];
    console.log(`Elemento ${elemento}`);
}

while(contador < lista.length){
    const elemento = lista[contador];
    console.log(`Elemento ${elemento}`);
    contador++;
}

lista.forEach(elemento => {
    console.log(`Elemento ${elemento}`);
});

do{
    const elemento = lista[contador];
    console.log(`Elemento ${elemento}`)
    contador --;
}while(contador > 0);

function alertar(){
let valor = document.getElementById('repete').value;
for (let i = 0; i < valor; i++) {
    alert(i);
}}