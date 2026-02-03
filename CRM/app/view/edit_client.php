<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../public/login.php");
        exit;
    }

    require_once "../model/Client.php";

    $clientModel = new Client();

    $id = $_GET['id'] ?? null;

    if (!$id) {
        header("Location: clients.php");
        exit;
    }

    $client = $clientModel->getById($id);

    if (!$client) {
        header("Location: clients.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Russi CRM</title>
    <link rel="stylesheet" href="../../public/assets/style/edit_client.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../public/assets/icon/account_tree_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" type="image/x-icon">
</head>
<body>
    
    <div class="layout">

    <aside class="sidebar">
        <h1 class="logo">Russi CRM</h1>
        <nav>
            <a href="clients.php">Voltar</a>
        </nav>
    </aside>

    <main class="main">

        <h2>Editar Cliente</h2>

        <form class="client-form" method="POST" action="../controller/ClientsController.php">

            <input type="hidden" name="action" value="update_client">
            <input type="hidden" name="id" value="<?= $client['id'] ?>">

            <input type="text" name="name" value="<?= htmlspecialchars($client['name']) ?>" required>
            <input type="email" name="email" value="<?= htmlspecialchars($client['email']) ?>">

            <input type="text" name="phone" value="<?= htmlspecialchars($client['phone']) ?>" required>
            <input type="text" name="company" value="<?= htmlspecialchars($client['company']) ?>">

            <select name="status">
                <option value="lead" <?= $client['status']=="lead" ? "selected":"" ?>>Lead</option>
                <option value="ativo" <?= $client['status']=="ativo" ? "selected":"" ?>>Ativo</option>
                <option value="fechado" <?= $client['status']=="fechado" ? "selected":"" ?>>Fechado</option>
                <option value="perdido" <?= $client['status']=="perdido" ? "selected":"" ?>>Perdido</option>
            </select>

            <select name="source">
                <option value="instagram" <?= $client['source']=="instagram"?"selected":"" ?>>Instagram</option>
                <option value="facebook" <?= $client['source']=="facebook"?"selected":"" ?>>Facebook</option>
                <option value="linkedin" <?= $client['source']=="linkedin"?"selected":"" ?>>LinkedIn</option>
                <option value="site" <?= $client['source']=="site"?"selected":"" ?>>Site</option>
                <option value="whatsapp" <?= $client['source']=="whatsapp"?"selected":"" ?>>WhatsApp</option>
                <option value="telefone" <?= $client['source']=="telefone"?"selected":"" ?>>Telefone</option>
                <option value="indicacao" <?= $client['source']=="indicacao"?"selected":"" ?>>Indicação</option>
            </select>

            <textarea name="notes"><?= htmlspecialchars($client['notes']) ?></textarea>

            <button type="submit">Salvar Alterações</button>

        </form>

    </main>

    </div>

</body>
</html>