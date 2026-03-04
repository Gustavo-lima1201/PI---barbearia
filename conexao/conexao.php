<?php
$host = "localhost";
$banco = "pi_barbearia";
$usuario = "root";
$senha = ""; // no XAMPP geralmente é vazio

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>