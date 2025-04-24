const precos = {
    "Não sei Burguer": 18.00,
    "Super Mega Blaster": 22.00,
    "Alguma Coisa Burguer": 25.00,
    "Nugget": 12.00,
    "Batata Frita": 8.00,
    "Anéis de Cebola": 10.00,
    "Guaraná": 7.00,
    "Coca Cola": 7.00,
    "Guaravita": 3.00,
};

let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

atualizarContadorCarrinho();

function adicionarAoCarrinho(nome) {
    const existente = carrinho.find(item => item.nome === nome);

    if (existente) {
        existente.quantidade++;
    } else {
        carrinho.push({ nome, quantidade: 1 });
    }

    localStorage.setItem("carrinho", JSON.stringify(carrinho));
    atualizarContadorCarrinho();
}

function atualizarContadorCarrinho() {
    const contador = document.getElementById("contador-carrinho");
    const totalItens = carrinho.reduce((soma, item) => soma + item.quantidade, 0);
    contador.textContent = totalItens;
}
