<?php

$livros = Livro::all($_REQUEST['pesquisar'] ?? null);

view('index', compact('livros'));
