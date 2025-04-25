<?php
$conexao = new mysqli("localhost", "root", "", "chapaquente");

$pedidos = $conexao->query("SELECT * FROM pedidos ORDER BY data DESC");

while ($pedido = $pedidos->fetch_assoc()) {
    echo "<h2>Pedido #{$pedido['id']} - Total: R$ {$pedido['total']} - {$pedido['data']}</h2>";

    $id = $pedido['id'];
    $itens = $conexao->query("SELECT * FROM itens_pedido WHERE pedido_id = $id");

    echo "<ul>";
    while ($item = $itens->fetch_assoc()) {
        echo "<li>{$item['nome']} x{$item['quantidade']} - R$ {$item['preco_unitario']}</li>";
    }
    echo "</ul><hr>";
}

$conexao->close();
?>
