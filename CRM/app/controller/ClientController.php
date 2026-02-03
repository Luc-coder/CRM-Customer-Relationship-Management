<?php

    session_start();

    // Importa arquivo de conexão
    require __DIR__ . '/../db/connection.php';

    // Importa arquivo de modelo
    require __DIR__ . '/../model/Client.php';

    // Cria novo objeto
    $clientModel = new Client();

    // Faz requisição do formulário de cadastro
    $action = $_POST['action'] ?? null;

    // Cria novo client
    if ($action === "create_client") {

        if (
            empty($_POST['name']) ||
            empty($_POST['phone'])
        ) {
            header("Location: ../view/clients.php?error=fields");
            exit;
        }

        $user_id = $_SESSION['user_id'];

        $name = $_POST['name'];
        $email = $_POST['email'] ?? null;
        $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
        $company = $_POST['company'] ?? null;
        $status = $_POST['status'] ?? 'lead';
        $source = $_POST['source'] ?? null;
        $notes = $_POST['notes'] ?? null;

        $clientModel->create(
            $user_id,
            $name,
            $email,
            $phone,
            $company,
            $status,
            $source,
            $notes
        );

        header("Location: ../view/clients.php?status=created");
        exit;
    }

    // Editar client cadastrado
    if ($action === "update_client") {

        if (empty($_POST['name']) || empty($_POST['phone'])) {
            header("Location: ../view/clients.php?error=fields");
            exit;
        }

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
        $company = $_POST['company'];
        $status = $_POST['status'];
        $source = $_POST['source'];
        $notes = $_POST['notes'];

        $clientModel->update(
            $id,
            $name,
            $email,
            $phone,
            $company,
            $status,
            $source,
            $notes
        );

        header("Location: ../view/clients.php?status=updated");
        exit;
    }

    // Deletar client dacastrado
    if ($action === "delete_client") {

        $id = $_POST['client_id'];

        if (empty($id)) {
            header("Location: ../view/clients.php?error=invalid");
            exit;
        }

        $clientModel->deleteClient($id);

        header("Location: ../view/clients.php?status=deleted");
        exit;
    }
?>