<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "mydb";
//criando a conexao
$conn = new mysqli($servidor, $usuario, $senha, $dbname);

//checando a conexao
if ($conn->connect_error) {
    die("A conexão falhou: " . $conn->connect_error);
} else {
    echo "Mysqli Conectado com sucesso<br>";
}
// sql de criacao da tabela
$sqlTable = "CREATE TABLE MyGuests (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

if ($conn->query($sqlTable) === TRUE) {
  echo "Table MyGuests criado com sucesso <br>";
} else {
  echo "Error ao criar a tabela: <br>" . $conn->error;
}

//Inserindo dados na tabela
$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Franck', 'Farias', 'Marcelo@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Mary', 'Moe', 'mary@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Julie', 'Dooley', 'julie@example.com')";

if ($conn->multi_query($sql) === TRUE) {
    // obter o ultimo id
    $ultimo_id = $conn->insert_id;
    echo "Novo registro criado com sucesso. O ultimo id eh <br>" . $ultimo_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
