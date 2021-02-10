<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=fullstackphp", $usuario, $senha);
    // setando o PDO error mode para excecao
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'PDO conectado com sucesso';
} catch (PDOException $exc) {
    echo "Conexão Falhou: " . $exc->getMessage();
}

$conn = null;


