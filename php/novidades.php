<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "chapaquente";

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se deu erro na conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta os dados da tabela
$sql = "SELECT * FROM novidades ORDER BY data DESC";
$resultado = $conn->query($sql);

// Exibe os dados
if ($resultado->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Título</th><th>Descrição</th><th>Data</th></tr>";
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["titulo"] . "</td>";
        echo "<td>" . $row["descricao"] . "</td>";
        echo "<td>" . date('d/m/Y', strtotime($row["data"])) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhuma novidade encontrada.";
}

$conn->close();
?>