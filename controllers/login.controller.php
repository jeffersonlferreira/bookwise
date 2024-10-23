<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validacao = Validacao::validar ([
        'email' => ['required', 'email'],
        'password' => ['required']
    ], $_POST);

    if($validacao->naoPassou('login')) {
        header('location: /login');
        exit();
    }

    $usuario = $database->query(
        query: "SELECT * FROM usuarios WHERE email = :email",
        class: Usuario::class,
        params: [
            'email' => $_POST['email']
        ]
    )->fetch();

    if($usuario) {

        if(!password_verify($_POST['password'], $usuario->password)) {

            flash()->push('validacoes_login', ['Usuario ou senha estão incorretos!']);

            header('location: /login');

            exit();
        }


        $_SESSION['auth'] = $usuario;

        flash()->push('mensagem', "Seja bem vindo {$usuario->nome}!.");

        header('location: /');

        exit();

    }
}

view('login');
