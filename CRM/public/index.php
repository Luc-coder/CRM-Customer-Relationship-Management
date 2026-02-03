<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Russi CRM</title>
    <link rel="stylesheet" href="./assets/style/index.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="./assets/icon/account_tree_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" type="image/x-icon">
</head>
<body>
    
    <?php if (isset($_GET['success']) && $_GET['success'] === "recover_email"): ?>
        <div class="success">
            Se este email existir, você receberá instruções em uma mensagem.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['success']) && $_GET['success'] === "recover_pass"): ?>
        <div class="success">
            Um email foi enviado para que você possa redefinir sua senha.
        </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['status']) && $_GET['status'] === "account_deleted"): ?>
        <div class="success">
            Conta excluída com sucesso.
        </div>
    <?php endif; ?>



    <header>
        <div class="logo">Russi CRM</div>
        <div class="nav-buttons">
            <a href="./login.php" class="login">Login</a>
            <a href="./signup.php" class="signup">Cadastro</a>
        </div>
    </header>

    <section class="hero">
        <div>
            <h1>Organize seus clientes.<br>Venda sem perder tempo.</h1>
            <p>O Russi CRM ajuda você a controlar leads, acompanhar vendas e crescer sua empresa sem bagunça.</p>
            <a href="./signup.php" class="btn">Começar agora</a>
        </div>
        <div class="hero-image"></div>
    </section>

    <section>
        <h2 class="section-title">Tudo que você precisa em um só lugar</h2>
        <div class="cards">
            <div class="card">
                <h3>Gestão de Leads</h3>
                <p>Centralize todos os seus contatos e nunca mais perca uma oportunidade.</p>
            </div>
            <div class="card">
                <h3>Pipeline de Vendas</h3>
                <p>Acompanhe cada etapa do funil de forma clara e objetiva.</p>
            </div>
            <div class="card">
                <h3>Histórico Completo</h3>
                <p>Veja todas as interações com seus clientes em um só lugar.</p>
            </div>
        </div>
    </section>

    <section>
        <div class="image-text">
            <div class="image-box"></div>
            <div>
                <h2>Feito para equipes modernas</h2>
                <p style="margin-top:16px; color: var(--gray);">
                    O Russi CRM foi pensado para ser simples, rápido e eficiente.
                    Menos burocracia, mais resultado no dia a dia.
                </p>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <h2 class="section-title">O que nossos usuários dizem</h2>
        <div class="cards">
            <div class="testimonial">
                <p>"Depois do Russi CRM, minhas vendas ficaram muito mais organizadas."</p>
                <strong>— Ana, Comercial</strong>
            </div>
            <div class="testimonial">
                <p>"Interface limpa e fácil. Dá gosto de usar."</p>
                <strong>— Lucas, Empreendedor</strong>
            </div>
            <div class="testimonial">
                <p>"Finalmente um CRM que não complica."</p>
                <strong>— Rafael, Startup Founder</strong>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2026 Russi CRM. Todos os direitos reservados.</p>
    </footer>

    <script src="./assets/js/index.js"></script>
</body>
</html>