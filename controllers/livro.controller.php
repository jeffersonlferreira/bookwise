<?php

$livro = Livro::get($_GET['id']);

$avaliacoes = $database->query(
    query: "SELECT * FROM avaliacoes WHERE livro_id = :id",
    class: Avaliacao::class,
    params: ['id' => $_GET['id']]
)->fetchAll();



view('livro', compact('livro', 'avaliacoes'));
