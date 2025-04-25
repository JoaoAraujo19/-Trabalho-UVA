<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $assunto = $_POST['assunto'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $mensagem = $_POST['mensagem'];
        
            $to = "chapaquenteog@gmail.com";
            $subject = "Formulário Chapa Quente: $assunto";
            $body = "Nome: $nome\nEmail: $email\nAssunto: $assunto\n\nMensagem:\n$mensagem";
            $headers = "From: $email";
        
            if (mail($to, $subject, $body, $headers)) {
                echo "<p style='color: green;'>Mensagem enviada com sucesso!</p>";
            } else {
                echo "<p style='color: red;'>Erro ao enviar a mensagem. Tente novamente.</p>";
            }
        }
        ?>