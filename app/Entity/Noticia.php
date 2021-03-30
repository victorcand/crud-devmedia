<?php

namespace App\Entity;

use App\Db\Database;
use PDO;

class Noticia
{
    public $id;
    public $titulo;
    public $categoria;
    public $conteudo;
    public $data;

    /**
     * Metodo responsavel por cadastrar uma nova vaga no banco
     *
     * @return boolean
     */
    public function cadastrar()
    {
        //DEFINIR A DATA
        $this->data = date('Y-m-d H:i:s');

        //INSERIR A NOTICIA NO BANCO
        $obDatabase = new Database('noticia');
        $this->id = $obDatabase->insert([
            'titulo' => $this->titulo,
            'categoria' => $this->categoria,
            'conteudo' => $this->conteudo
        ]);

        //RETORNAR SUCESSO
        return true;
    }


    /**
     * Metodo responsavel por atualizar a vaga no banco
     *
     * @return boolean
     */
    public function atualizar()
    {
        return (new Database('noticia'))->update('id = '.$this->id,[
            'titulo' => $this->titulo,
            'categoria' => $this->categoria,
            'conteudo' => $this->conteudo,
        ]);
    }

    /**
     * Método responsavel por excluir a vaga no banco
     *
     * @return boolean
     */
    public function excluir()
    {
        return (new Database('noticia'))->delete('id= '.$this->id);
    }


    /**
     * Metodo responsavel por obter as noticias do banco de dados
     *
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getNoticias($where = null, $order = null, $limit = null)
    {
        return (new Database('noticia'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Metodo responsavel por buscar uma vaga com base em seu ID
     *
     * @param integer $id
     * @return Noticia
     */
    public static function getNoticia($id)
    {
        return (new Database('noticia'))->select('id = ' . $id)
                                        ->fetchObject(self::class);
    }
}

