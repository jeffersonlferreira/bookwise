<?php

function view($view, $data = [])
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    require 'views/templates/app.php';
}

function dd(...$dump)
{
    dump($dump);
    die();
};

function dump(...$dump)
{
    echo '<pre>';
    var_dump($dump);
    echo '</pre>';
};

function abort(int $codigo)
{
    http_response_code($codigo);
    view('404');
    die();
}

function flash()
{
    return new Flash;
}

function config($chave = null)
{
    $config = require 'config.php';

    if(strlen($chave) > 0) {

        return $config[$chave];

    }

    return $config;

}

function auth()
{

    if(!isset($_SESSION['auth'])) {

        return null;

    }

    return $_SESSION['auth'];

}
