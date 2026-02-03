<?php

    session_start();

    // Importa arquivo de conexão
    require __DIR__ . '/../db/connection.php';

    // Importa arquivo de modelo
    require __DIR__ . '/../model/User.php';

    // Cria novo objeto
    $userModel = new User();

    // Faz requisição do formulário de cadastro
    $action = $_POST['action'] ?? null;

    // Chama a lógica de cadastro
    if ($action === "signup") {

        // Validação básica
        if (
            empty($_POST['company']) ||
            empty($_POST['name']) ||
            empty($_POST['phone']) ||
            empty($_POST['email']) ||
            empty($_POST['password'])
        ) {
            header("Location: ../../public/signup.php?error=fields");
            exit;
        }

        // Recebe os valores do form
        $company = $_POST['company'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // Verifica número de telefone celular
        $phoneCheck = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phoneCheck) < 10) {
            header("Location: ../../public/signup.php?error=phone");
            exit;
        }

        // Hash da senha
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Cadastra os dados
        $userModel->createNewUser($company, $name, $phone, $email, $password);

        // Redireciona para index após cadastro realizado
        header("Location: ../../public/index.php");
        exit;

    }

    // Chama a lógica de login
    if ($action === "login") {

        if (
            empty($_POST['email']) ||
            empty($_POST['password'])
        ) {
            die('Dados inválidos');
        } 

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userModel->getUserByEmail($email);

        // Verifica se user existe
        if (!$user) {

           header("Location: ../../public/login.php?error=invalid");
            exit;

        }

        // Verirfica se senha está correta
        if (!password_verify($password, $user['password'])) {

            header("Location: ../../public/login.php?error=invalid");
            exit;

        }

        // inicia sessão
        session_start();

        // guarda dados essenciais
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_company'] = $user['company'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_phone'] = $user['phone'];

        // redireciona para dashboard
        header("Location: ../../app/view/dashboard.php");
        exit;

    }

    // Recuperação / troca de email
    if ($action === "recover_email") {

        header("Location: ../../public/index.php?success=recover_email");
        exit;

    }

    // Recuperação da senha
    if ($action === "recover_pass") {

        header("Location: ../../public/index.php?success=recover_pass");
        exit;

    }

    // Altera dados cadastrais do user
    if ($action === "change_user_data") {

        // Validação básica
        if (
            empty($_POST['company']) ||
            empty($_POST['name']) ||
            empty($_POST['phone']) ||
            empty($_POST['email'])
        ) {
            header("Location: ../view/user_config.php?error=fields");
            exit;
        }

        // Recebe os valores do form
        $id = $_POST['user_id'];
        $company = $_POST['company'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Verifica número de telefone celular
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone) < 10) {
            header("Location: ../view/user_config.php?error=phone");
            exit;
        }

        // Verifica se email ja existe no banco
        $existingUser = $userModel->getUserByEmail($email);

        if ($existingUser && $existingUser['id'] != $id) {
            header("Location: ../view/user_config.php?error=email");
            exit;
        }

        // Método para atualizar os dados
        $userModel->updateUser($company, $name, $email, $phone, $id);

        // Atualiza dados da session
        $_SESSION['user_name'] = $name;
        $_SESSION['user_company'] = $company;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_phone'] = $phone;

        // Redireciona para index após alteração de dados
        header("Location: ../view/user_config.php?status=updated");
        exit;

    }

    // Troca senha so user
    if ($action === "change_user_pass") {

        // Validação básica
        if (
            empty($_POST['password']) ||
            empty($_POST['new_pass']) ||
            empty($_POST['new_pass2']) 
        ) {
            header("Location: ../view/user_config.php?error=fields");
            exit;
        }

        // Recebe os valores do form
        $id = $_POST['user_id'];
        $password = $_POST['password'];
        $new_pass = $_POST['new_pass'];
        $new_pass2 = $_POST['new_pass2'];

        // Verifica se as novas senhas são iguais
        if ($new_pass !== $new_pass2) {
            header("Location: ../view/user_config.php?error=pass_dif");
            exit;
        }

        // Busca user
        $user = $userModel->getUserById($id);

        if (!$user) {
            header("Location: ../view/user_config.php?error=user");
            exit;
        }

        // Verifica senha atual
        if (!password_verify($password, $user['password'])) {
            header("Location: ../view/user_config.php?error=wrong_pass");
            exit;
        }

        // Cria hash nova senha
        $newHash = password_hash($new_pass, PASSWORD_DEFAULT);

        // Atualiza
        $userModel->updateUserPassword($newHash, $id);

        header("Location: ../view/user_config.php?status=pass_updated");
        exit;

    }


    // Deleta conta do user
    if ($action === "delete_account") {

        $id = $_POST['user_id'];

        if (empty($id)) {
            header("Location: ../view/user_config.php?error=user");
            exit;
        }

        $userModel->deleteUser($id);

        session_start();
        session_destroy();

        header("Location: ../../public/index.php?status=account_deleted");
        exit;
    }


?>