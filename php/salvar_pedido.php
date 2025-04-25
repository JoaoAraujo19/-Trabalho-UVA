<?php
header("Content-Type: application/json");
require 'conexao.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !is_array($data)) {
    echo json_encode(["status" => "error", "message" => "Dados inválidos"]);
    exit;
}

$total_geral = 0;
$itens = [];

foreach ($data as $item) {
    $nome = $item['nome'];
    $quantidade = $item['quantidade'];
    $preco_unitario = 0;

    // Definindo os preços
    switch ($nome) {
        case "Não sei Burguer": $preco_unitario = 18.00; break;
        case "Super Mega Blaster": $preco_unitario = 22.00; break;
        case "Alguma Coisa Burguer": $preco_unitario = 25.00; break;
        case "Nugget": $preco_unitario = 12.00; break;
        case "Batata Frita": $preco_unitario = 8.00; break;
        case "Anéis de Cebola": $preco_unitario = 10.00; break;
        case "Guaraná": $preco_unitario = 7.00; break;
        case "Coca Cola": $preco_unitario = 7.00; break;
        case "Guaravita": $preco_unitario = 3.00; break;
        default: continue;
    }

    $subtotal = $quantidade * $preco_unitario;
    $total_geral += $subtotal;

    $itens[] = [
        'nome' => $nome,
        'quantidade' => $quantidade,
        'preco_unitario' => $preco_unitario
    ];
}

// 1. Inserir o pedido e obter o ID
$stmt_pedido = $conn->prepare("INSERT INTO pedidos (total) VALUES (?)");
$stmt_pedido->bind_param("d", $total_geral);
$stmt_pedido->execute();
$pedido_id = $stmt_pedido->insert_id;

// 2. Inserir os itens relacionados
$stmt_item = $conn->prepare("INSERT INTO itens_pedido (pedido_id, nome, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");

foreach ($itens as $item) {
    $stmt_item->bind_param("isid", $pedido_id, $item['nome'], $item['quantidade'], $item['preco_unitario']);
    $stmt_item->execute();
}

echo json_encode(["status" => "success", "pedido_id" => $pedido_id]);
?>
