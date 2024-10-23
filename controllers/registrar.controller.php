<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validacao = Validacao::validar ([
        'name' => ['required'],
        'email' => ['required', 'email', 'confirmed', 'unique:usuarios'],
        'password' => ['required', 'min:8', 'max:30', 'strong']
    ], $_POST);

    if($validacao->naoPassou('registrado')) {
        header('location: /login');
        exit();
    }

    $database->query(
        query: "INSERT INTO usuarios (nome, email, password) VALUES (:name, :email, :password)",
        params: [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]
    );

    flash()->push('mensagem', "Registrado com sucesso!👍");

    header('location: /login');

    exit();

}

header('location: /login');

exit();
