<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Russi CRM</title>
    <link rel="stylesheet" href="./assets/style/login.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="./assets/icon/account_tree_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" type="image/x-icon">
</head>
<body>

    <div class="container">
        <div class="logo">Russi CRM</div>
        <div class="subtitle">Entre na sua conta</div>

        <?php if (isset($_GET['error'])): ?>
            <p class="error">Email ou senha inválidos.</p>
        <?php endif; ?>


        <form method="POST" action="../app/controller/UserController.php">
            <input type="hidden" name="action" value="login" />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>

        <div class="footer-text">
            Não tem conta?
            <a href="signup.php">Criar agora</a>
            <br>
            Esqueci meu
            <a href="../app/view/reset_email.php">Email</a>
            <br>
            Esqueci minha
            <a href="../app/view/reset_pass.php">Senha</a>
            <br>
            <a href="./help.html">Ajuda</a>
        </div>
    </div>
    
</body>
</html>