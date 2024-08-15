<?php

include `/includes/connect.php`;

// Conexão com o banco de dados
$conn = new mysqli($host, $username, $password, $database);

// Verificar se a conexão falhou
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtendo os dados do formulário
$name = $_POST['name'];
$email = $_POST['email'];
$position = $_POST['position'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];

// Verificar se a senha e a confirmação de senha coincidem
if ($password !== $confirm_password) {
    die("As senhas não coincidem.");
}

// Hashe para armazenar senhas
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Preparando a instrução SQL para inserção
$sql = "INSERT INTO users (name, email, position, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Verificar se a preparação da instrução falhou
if (!$stmt) {
    die("Preparação falhou: " . $conn->error);
}

// Bind dos parâmetros
$stmt->bind_param("ssss", $name, $email, $position, $hashed_password);

// Executando a instrução
if ($stmt->execute()) {
    echo "Usuário registrado com sucesso!";
} else {
    echo "Erro ao registrar usuário: " . $stmt->error;
}

// Fechando a instrução e a conexão
$stmt->close();
$conn->close();
?>
