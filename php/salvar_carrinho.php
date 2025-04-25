<?php
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    session_start();
    $_SESSION['carrinho'] = $data;

    // Conexão com banco
    $conn = new mysqli("localhost", "root", "", "chapaquente");

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Inserir na tabela pedidos
    $sqlPedido = "INSERT INTO pedidos (data_pedido) VALUES (NOW())";
    if ($conn->query($sqlPedido) === TRUE) {
        $idPedido = $conn->insert_id;

        // Inserir cada item do carrinho
        foreach ($data as $item) {
            $nome = $conn->real_escape_string($item['nome']);
            $quantidade = (int)$item['quantidade'];
            $sqlItem = "INSERT INTO itens_pedido (id_pedido, produto, quantidade) VALUES ($idPedido, '$nome', $quantidade)";
            $conn->query($sqlItem);
        }

        echo "Carrinho salvo com sucesso!";
    } else {
        echo "Erro ao salvar pedido.";
    }

    $conn->close();
} else {
    echo "Erro ao processar os dados.";
}
?>
