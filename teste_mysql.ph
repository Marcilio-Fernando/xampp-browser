<?php
$host = 'db'; // nome do serviço MySQL no docker-compose
$user = 'usuario'; // mesmo nome definido no docker-compose.yml
$pass = 'senha';   // mesma senha definida lá
$dbname = 'exemplo'; // nome do banco

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
echo "✅ Conectado ao MySQL com sucesso!";
?>
