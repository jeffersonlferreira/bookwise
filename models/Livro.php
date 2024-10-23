<?php

class Livro
{

    public $id;
    public $titulo;
    public $autor;
    public $descricao;
    public $imagem;
    public $ano_de_lancamento;
    public $usuario_id;
    public $nota_avaliacao;
    public $count_avaliacoes;

    public static function query($where, $params)
    {
        $database = new Database(config('database'));

        return $database->query(
            query: "SELECT
                        l.*,
                        ifnull(round(sum(a.nota) / 5.0), 0) as nota_avaliacao,
                        ifnull(count (a.id), 0) as count_avaliacoes
                    FROM livros l
                    LEFT JOIN avaliacoes a ON a.livro_id = l.id
                    WHERE $where
                    GROUP BY l.id",
            class: self::class,
            params: $params);
    }

    public static function get($id)
    {

        return (new self)->query('l.id = :id', ['id' => $id])->fetch();

    }

    public static function all($filtro)
    {

        return (new self)->query('l.titulo like :filtro', ['filtro' => "%{$filtro}%"])->fetchAll();

    }

    public static function meus($usuario_id)
    {

        return (new self)->query('l.usuario_id = :usuario_id', ['usuario_id' => $usuario_id])->fetchAll();

    }

};

