<?php
session_start();
// ... (restante do seu código)

// Preparando a consulta com prepared statements para evitar SQL injection
$stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ianquesjoslaine@gmail.com AND senha = 12345 AND adm = 1");
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Usuário é administrador
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['adm'] = 1; // Define a sessão 'adm' como 1 para indicar que o usuário é administrador
    header('Location: sistema.php');
} else {
    // Verifica se o usuário existe (não é administrador)
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: pg-principal.php');
    } else {
        // Usuário ou senha inválidos
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
}