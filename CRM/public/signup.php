<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Russi CRM</title>
    <link rel="stylesheet" href="./assets/style/signup.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="./assets/icon/account_tree_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" type="image/x-icon">
</head>
<body>

    <div class="container">
        <div class="logo">Russi CRM</div>
        <div class="subtitle">Crie sua conta</div>

        <?php if (isset($_GET['error']) && $_GET['error'] === "fields"): ?>
            <p class="error">Preencha todos os campos.</p>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === "phone"): ?>
            <p class="error">O telefone só pode conter números.</p>
        <?php endif; ?>
    


        <form method="POST" action="../app/controller/UserController.php">
            <input type="hidden" name="action" value="signup" />

            <label for="company">Nome da Empresa</label>
            <input type="text" id="company" name="company" required>

            <label for="name">Seu nome</label>
            <input type="text" id="name" name="name" required>

            <label for="">Telefone</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]+" inputmode="numeric" placeholder="Somente números" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Criar conta</button>
        </form>

        <div class="footer-text">
            Já tem conta?
            <a href="login.php">Entrar</a>
        </div>
    </div>
    
    <script src="./assets/js/signup.js"></script>
</body>
</html>