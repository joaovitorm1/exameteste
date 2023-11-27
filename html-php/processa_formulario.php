<?php
// Verifica se o formulário foi enviado
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Exibe os dados na tela
    echo "Nome: $nome <br>";
    echo "Email: $email <br>";

    // Verifica se o campo de nome não está vazio
    if(empty($nome)) {
        echo "O campo nome não pode estar vazio.";
    }

    // Verifica se o campo de email é válido
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "O campo email não é um endereço de email válido.";
    }

    // Armazena os dados no banco de dados
    $conexao = new PDO('mysql:host=127.0.0.1;dbname=teste','root','root');
    $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $email);
    $stmt->bindValue(3, md5($senha));
    $stmt->execute();
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}else{
    echo 'informações invalidas';
}
?>