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

const container = document.getElementById("lista-carrinho");

function atualizarCarrinho() {
    container.innerHTML = "";
    let total = 0;

    carrinho.forEach(item => {
        const linha = document.createElement("div");
        linha.innerHTML = `
            ${item.nome} x ${item.quantidade} — R$ ${(precos[item.nome] * item.quantidade).toFixed(2)}
            <button onclick="remover('${item.nome}')">Remover</button>
        `;
        container.appendChild(linha);
        total += (precos[item.nome] || 0) * item.quantidade;
    });

    const totalDiv = document.createElement("div");
    totalDiv.innerHTML = `<strong>Total: R$ ${total.toFixed(2)}</strong>`;
    container.appendChild(totalDiv);


    const finalizarCompraBtn = document.createElement("button");
    finalizarCompraBtn.textContent = "Finalizar Compra";
    finalizarCompraBtn.onclick = finalizarCompra;
    container.appendChild(finalizarCompraBtn);
}

function remover(nome) {
    const item = carrinho.find(i => i.nome === nome);

    if (item) {
        item.quantidade--;
        if (item.quantidade <= 0) {
            carrinho = carrinho.filter(i => i.nome !== nome);
        }
    }

    localStorage.setItem("carrinho", JSON.stringify(carrinho));
    atualizarCarrinho();
}

function finalizarCompra() {
    if (carrinho.length > 0) {
        
        alert("Compra finalizada com sucesso!\nItens: " + carrinho.map(item => `${item.nome} (${item.quantidade})`).join(", ") + "\nTotal: R$ " + calcularTotal().toFixed(2));

        // Limpa o carrinho após a finalização (opcional)
        carrinho = [];
        localStorage.removeItem("carrinho");
        atualizarCarrinho();
    } else {
        alert("Seu carrinho está vazio. Adicione itens para finalizar a compra.");
    }
}

function calcularTotal() {
    let total = 0;
    carrinho.forEach(item => {
        total += (precos[item.nome] || 0) * item.quantidade;
    });
    return total;
}

atualizarCarrinho();