<?php
session_start(); // Iniciar a sessão

// Verificar se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirecionar para o login se não estiver autenticado
    exit();
}

// Obter o nome de usuário ou e-mail da sessão
$username = htmlspecialchars($_SESSION['login']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">Minha Aplicação</div>
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
        <!-- Conteúdo adicional do dashboard aqui -->
        <button class="logout-button" onclick="window.location.href='logout.php';">Sair</button>
    </div>
</body>
</html>
