<?php

include '/includes/connect.php';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$login = $_POST['login'];
$password = $_POST['password'];

if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
    $sql = "SELECT password FROM users WHERE email = ?";
} else {
    $sql = "SELECT password FROM users WHERE username = ?";
}

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Preparação falhou: " . $conn->error);
}

$stmt->bind_param("s", $login);

$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    die("E-mail ou nome de usuário não encontrado.");
}

$stmt->bind_result($hashed_password);
$stmt->fetch();

if (password_verify($password, $hashed_password)) {
    echo "Login bem-sucedido!";
    
    $_SESSION['user_id'] = $user_id;
    $_SESSION['login'] = $login;

    header("Location: dashboard.php");
    exit();
} else {
    echo "Senha incorreta.";
}

$stmt->close();
$conn->close();
?>
