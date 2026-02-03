<?php

    session_start();

    // Importa arquivo de conexão
    require __DIR__ . '/../db/connection.php';

    // Importa arquivo de modelo
    require __DIR__ . '/../model/Message.php';

    // Cria novo objeto
    $messageModel = new Message();

    // Faz requisição do formulário de cadastro
    $action = $_POST['action'] ?? null;

    // Envia mensagem 
    if ($action === "send") {

        if (empty($_POST['message']) || empty($_POST['client_id'])) {
            header("Location: ../view/mensage.php");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $client_id = $_POST['client_id'];
        $message = $_POST['message'];

        $messageModel->sendMessage(
            $user_id,
            $client_id,
            "user",
            $message
        );

        header("Location: ../view/mensage.php?client=".$client_id);
        exit;
    }

?>