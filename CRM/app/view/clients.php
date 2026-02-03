<?php

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../public/login.php");
        exit;
    }

    require_once "../model/Client.php";
    $clientModel = new Client();
    $clients = $clientModel->getAllByUser($_SESSION['user_id']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Russi CRM</title>
    <link rel="stylesheet" href="../../public/assets/style/clients.css" />
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
            <a class="active" href="clients.php">Clientes</a>
            <a href="mensage.php">Mensagens</a>
            <a href="user_config.php">Configurações</a>
            <a class="logout" href="../controller/LogoutController.php">Sair</a>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <header class="topbar">
            <h2>Clientes</h2>
            <button class="new">+ Novo cliente</button>
        </header>

        <?php if (isset($_GET['status']) && $_GET['status'] === "deleted"): ?>
            <div class="success">Cliente excluído com sucesso.</div>
        <?php endif; ?>


        <?php if (isset($_GET['status']) && $_GET['status'] === "created"): ?>
            <p class="success">Cliente cadastrado com sucesso.</p>
        <?php endif; ?>

        <form class="client-form" method="POST" action="../controller/ClientController.php">

            <input type="hidden" name="action" value="create_client">

            <input type="text" name="name" placeholder="Nome do cliente" required>
            <input type="email" name="email" placeholder="Email">

            <input type="text" name="phone" placeholder="Telefone" required>
            <input type="text" name="company" placeholder="Empresa">

            <select name="status">
                <option value="lead">Lead</option>
                <option value="ativo">Ativo</option>
                <option value="fechado">Fechado</option>
                <option value="perdido">Perdido</option>
            </select>

            <select name="source">
                <option value="">Origem do cliente</option>
                <option value="instagram">Instagram</option>
                <option value="facebook">Facebook</option>
                <option value="linkedin">LinkedIn</option>
                <option value="site">Site</option>
                <option value="whatsapp">WhatsApp</option>
                <option value="telefone">Telefone</option>
                <option value="indicacao">Indicação</option>
                <option value="outro">Outro</option>
            </select>


            <textarea name="notes" placeholder="Observações"></textarea>

            <button type="submit">Salvar Cliente</button>

        </form>


        <section class="clients-box">

            <div class="clients-actions">
                <input type="text" placeholder="Buscar cliente...">
            </div>

            <table>

                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($row = $clients->fetch_assoc()): ?>

                <tr>
                    <td><?=  htmlspecialchars($row['company']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['source']) ?></td>
                    <td>
                        <span class="status <?= $row['status'] ?>">
                            <?= ucfirst($row['status']) ?>
                        </span>
                    </td>

                    <td>
                        <a class="btn edit" href="edit_client.php?id=<?= $row['id'] ?>">Editar</a>                        <form method="POST" action="../controller/ClientController.php" style="display:inline;">
                            <input type="hidden" name="action" value="delete_client">
                            <input type="hidden" name="client_id" value="<?= $row['id'] ?>">
                            <button class="btn delete" onclick="return confirm('Deseja realmente excluir este cliente?')">
                                Excluir
                            </button>
                        </form>

                    </td>
                </tr>

                <?php endwhile; ?>

                </tbody>


            </table>

        </section>

    </main>

    </div>

</body>
</html>