<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../public/login.php");
        exit;
    }

    $userName = $_SESSION['user_name'];
    $userCompany = $_SESSION['user_company'];
    $userEmail = $_SESSION['user_email'];
    $userPhone = $_SESSION['user_phone'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Russi CRM</title>
    <link rel="stylesheet" href="../../public/assets/style/user_config.css" />
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
            <a href="mensage.php">Mensagens</a>
            <a class="active" href="user_config.php">Configurações</a>
            <a class="logout" href="../controller/LogoutController.php">Sair</a>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="main">

    <header class="topbar">
        <h2>Configurações da Conta</h2>
    </header>

    <!-- PERFIL -->
    <section class="card">

        <h3>Informações Pessoais</h3>

        <?php if (isset($_GET['error']) && $_GET['error'] === "fields"): ?>
            <p class="error">Preencha todos os campos.</p>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === "phone"): ?>
            <p class="error">O telefone só pode conter números.</p>
        <?php endif; ?>

         <?php if (isset($_GET['status']) && $_GET['status'] === "updated"): ?>
            <p class="success">
                Seus dados foram atualizados com sucesso!
            </p>
        <?php endif;?> 

        <form method="POST" action="../controller/UserController.php">
            <input type="hidden" name="action" value="change_user_data" />
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

            <div class="grid">

                <div>
                    <label>Nome</label>
                    <input type="text" value="<?= htmlspecialchars($userName) ?>" name="name" id="name" />
                </div>

                <div>
                    <label>Empresa</label>
                    <input type="text" value="<?= htmlspecialchars($userCompany) ?>" name="company" id="company" />
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" value="<?= htmlspecialchars($userEmail) ?>" name="email" id="email" />
                </div>

                <div>
                    <label>Telefone</label>
                    <input type="text" value="<?= htmlspecialchars($userPhone) ?>" name="phone" id="phone" />
                </div>

            </div>

            <button type="submit">Salvar alterações</button>

        </form>

    </section>

    <!-- SENHA -->
    <section class="card">

        <h3>Alterar Senha</h3>

        <?php if (isset($_GET['error']) && $_GET['error'] === "pass_dif"): ?>
            <p class="error">As senhas não coincidem.</p>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === "wrong_pass"): ?>
            <p class="error">Senha atual incorreta.</p>
        <?php endif; ?>

        <?php if (isset($_GET['status']) && $_GET['status'] === "pass_updated"): ?>
            <p class="success">Senha atualizada com sucesso.</p>
        <?php endif; ?>


        <form method="POST" action="../controller/UserController.php">
            <input type="hidden" name="action" value="change_user_pass" />
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

            <label>Senha Atual</label>
            <input type="password" name="password" id="password" />

            <label>Nova Senha</label>
            <input type="password" name="new_pass" id="new_pass" />

            <label>Confirmar Nova Senha</label>
            <input type="password" name="new_pass2" id="new_pass2" />

            <button type="submit">Atualizar senha</button>

        </form>

    </section>

    <!-- CONTA -->
    <section class="card danger">

        <h3>Zona de Perigo</h3>

        <p>Excluir sua conta é permanente e não pode ser desfeito.</p>

        <form method="POST" action="../controller/UserController.php"
            onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">

            <input type="hidden" name="action" value="delete_account">
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

            <button class="delete">Excluir minha conta</button>

        </form>

    </section>

    </main>

    </div>

</body>
</html>