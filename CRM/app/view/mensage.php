<?php

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../public/login.php");
        exit;
    }

    require_once "../model/Client.php";
    require_once "../model/Message.php";

    $clientModel = new Client();
    $messageModel = new Message();

    $clients = $clientModel->getClientsByUser($_SESSION['user_id']);

    $client_id = $_GET['client'] ?? null;

    $messages = [];

    if ($client_id) {
        $messages = $messageModel->getMessages(
            $_SESSION['user_id'],
            $client_id
        );
    }

    $clientName = "";

    if ($client_id) {
        $clientData = $clientModel->getClientById($client_id);
        $clientName = $clientData['name'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Russi CRM</title>
    <link rel="stylesheet" href="../../public/assets/style/mensage.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../public/assets/icon/account_tree_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" type="image/x-icon">
</head>
<body>
    
    <div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h1 class="logo">Russi CRM</h1>

        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="clients.php">Clientes</a>
            <a class="active" href="mensage.php">Mensagens</a>
            <a href="user_config.php">Configurações</a>
            <a class="logout" href="../controller/LogoutController.php">Sair</a>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="main">

    <header class="topbar">
        <h2>Mensagens</h2>
        <button class="new">+ Nova mensagem</button>
    </header>

    <div class="chat-layout">

    <!-- LISTA -->
    <section class="conversations">

        <input type="text" placeholder="Buscar conversa...">

        <?php while($c = $clients->fetch_assoc()): ?>

        <a href="mensage.php?client=<?= $c['id'] ?>" 
        class="conversation <?= ($client_id == $c['id']) ? 'active' : '' ?>">

            <h4><?= htmlspecialchars($c['name']) ?></h4>
            <p>Clique para abrir conversa</p>

        </a>

        <?php endwhile; ?>

    </section>


    <!-- CHAT -->
    <section class="chat">

        <?php if(!$client_id): ?>
            <p style="padding:40px;color:#94a3b8;">Selecione um cliente para iniciar a conversa.</p>
        <?php else: ?>

        <div class="chat-header">
            <h3><?= htmlspecialchars($clientName) ?></h3>
            <span>Online</span>
        </div>


       <div class="messages">

            <?php while($msg = $messages->fetch_assoc()): ?>

                <div class="msg <?= $msg['sender'] === 'user' ? 'sent' : 'received' ?>">
                    <?= htmlspecialchars($msg['message']) ?>
                </div>

            <?php endwhile; ?>

        </div>


        <form class="chat-input" 
            method="POST" 
            action="../controller/MessageController.php">

             <input type="hidden" name="action" value="send">
        <input type="hidden" name="client_id" value="<?= $client_id ?>">

            <input type="text" name="message" placeholder="Digite uma mensagem..." required>
            <button type="submit">Enviar</button>

        </form>

       <?php endif; ?>
         
    </section>

    </div>

    </main>

    </div>

    <script src="../../public/assets/js/message.js"></script>
</body>
</html>