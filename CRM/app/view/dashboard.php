<?php

    session_start();

    // if (!isset($_SESSION['user_id'])) {
    //     header("Location: ../public/login.php");
    //     exit;
    // }

    $userName = $_SESSION['user_name'];
    $userCompany = $_SESSION['user_company'];

    require_once "../model/Client.php";
    require_once "../model/Message.php";

    $clientModel = new Client();
    $messageModel = new Message();

    $totalClients = $clientModel->countClients($_SESSION['user_id']);
    $totalLeads = $clientModel->countLeads($_SESSION['user_id']);
    $totalMessages = $messageModel->countMessages($_SESSION['user_id']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Russi CRM</title>
    <link rel="stylesheet" href="../../public/assets/style/dashboard.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="../../public/assets/icon/account_tree_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" type="image/x-icon">
</head>
<body>
    
    <div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <h1 class="logo">Russi CRM</h1>

        <nav>
            <a class="active" href="#">Dashboard</a>
            <a href="./clients.php">Clientes</a>
            <a href="./mensage.php">Mensagens</a>
            <a href="./user_config.php">Configurações</a>
            <a class="logout" href="../controller/LogoutController.php">Sair</a>
        </nav>

    </aside>

    <!-- MAIN -->
    <main class="main">

    <header class="topbar">
        <div>
            <h2><?= htmlspecialchars($userCompany) ?></h2>
            <p>Bem-vindo, <?= htmlspecialchars($userName) ?></p>
        </div>
    </header>

    <section class="cards">

        <div class="card">
            <h3>Clientes</h3>
            <p class="number"><?= $totalClients ?></p>
        </div>

        <div class="card">
            <h3>Leads</h3>
            <p class="number"><?= $totalLeads ?></p>
        </div>

        <div class="card">
            <h3>Mensagens</h3>
            <p class="number"><?= $totalMessages ?></p>
        </div>

    </section>

    <section class="content">

        <div class="box">
            <h3>Atividades Recentes</h3>
            <p>Nenhuma atividade registrada.</p>
        </div>

        <div class="box">
            <h3>Mensagens por mês</h3>

            <div class="chart">

                <div class="bar">
                    <span>Jan</span>
                    <div style="height:40%"></div>
                </div>

                <div class="bar">
                    <span>Fev</span>
                    <div style="height:65%"></div>
                </div>

                <div class="bar">
                    <span>Mar</span>
                    <div style="height:30%"></div>
                </div>

                <div class="bar">
                    <span>Abr</span>
                    <div style="height:80%"></div>
                </div>

                <div class="bar">
                    <span>Mai</span>
                    <div style="height:55%"></div>
                </div>

            </div>

        </div>

    </section>

    </main>

    </div>

</body>
</html>