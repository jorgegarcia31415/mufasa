<?php
session_start();
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        echo "¡Bienvenido, " . htmlspecialchars($user['email']) . "!";
        // Puedes redirigir a otra página con header('Location: dashboard.php');
        exit;
    } else {
        echo "Email o contraseña incorrectos.";
    }
} else {
    echo "Acceso no permitido.";
}
?>