<?php
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    session_start();
    $_SESSION['carrinho'] = $data;

    // Aqui você poderia salvar no banco se quiser que nao sei o que
    echo "Carrinho salvo com sucesso!";
} else {
    echo "Erro ao salvar o carrinho.";
}
?>
