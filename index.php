<?php
session_start(); // Iniciar a sessão

if (!isset($_SESSION['user_id'])) {
    header("Location: user_session/login.html"); // Redirecionar para o login se não estiver autenticado
    exit();
}

$username = htmlspecialchars($_SESSION['login']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Flux</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">Data Flux</div>
        <div class="nav-links">
            <a href="profile.php">Perfil</a>
            <a href="settings.php">Configurações</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>
    <div class="container">
        <div class="welcome-message">
            Bem-vindo de volta, <?php echo $username; ?>!
        </div>
        <p>Aqui estão as últimas atualizações e informações relevantes para você.</p>

        <button class="logout-button" onclick="window.location.href='user_session/logout.php';">Sair</button>
    </div>
</body>
</html>
