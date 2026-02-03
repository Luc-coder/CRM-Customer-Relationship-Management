<?php

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Russi CRM</title>
    <link rel="stylesheet" href="../../public/assets/style/reset_email.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../public/assets/icon/account_tree_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" type="image/x-icon">
</head>
<body>
    
    <div class="auth-container">

        <form method="POST" action="../controller/UserController.php" class="auth-form">
            <input type="hidden" name="action" value="recover_email" />

            <h2>Recuperar Email</h2>
            <p class="subtitle">
                Informe seu telefone para recuperar seu email cadastrado.
            </p>

            <input type="hidden" name="action" value="recover_email">

            <label for="phone">Telefone</label>
            <input type="text" id="phone" name="phone" placeholder="(00) 00000-0000" required>

            <button type="submit">Recuperar email</button>

            <div class="links">
                <a href="../../public/login.php">Voltar para login</a>
            </div>

        </form>

    </div>

</body>
</html>