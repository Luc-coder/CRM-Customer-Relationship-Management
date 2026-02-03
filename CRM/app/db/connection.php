<?php

    // Dados do host
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "crm";
    
    // Cria conexão
    $conn = new mysqli($servername, $username, $password, $db);

    // Testa conexão
    if ($conn->connect_error) {
        die("Conexão falhou" . $conn->connect_error);
    }

    // Config
    $conn->set_charset("utf8mb4");

?>