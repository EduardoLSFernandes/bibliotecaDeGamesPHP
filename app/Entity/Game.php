<?php

namespace App\Entity;

use App\Db\Database;
use PDO;

class Game
{
    public $id;
    public $titulo;
    public $descricao;
    public $status;
    public $data;

    //METODO PARA CADASTRO DE JOGO NO DB
    public function cadastrar()
    {
        //DEFINIR DATA
        $this->data = date('Y-m-d H:i:s');

        //INSERIR JOGO NO DB
        $obDatabase = new Database('games');
        $this->id = $obDatabase->insert([
            'titulo'    => $this->titulo,
            'descricao' => $this->descricao,
            'status'    => $this->status,
            'data'      => $this->data
        ]);

        //RETORNAR SUCESSO
        return true;
    }

    //METODO PARA ATALIZAR JOGO NO DB
    public function atualizar()
    {
        return (new Database('games'))->update('id = ' . $this->id, [
            'titulo'    => $this->titulo,
            'descricao' => $this->descricao,
            'status'    => $this->status,
            'data'      => $this->data
        ]);
    }

    //METODO RESPONSAVEL POR EXCLUIR O JOGO DO DB
    public function excluir()
    {
        return (new Database('games'))->delete('id = ' . $this->id);
    }

    //METODO PARA OBTER JOGOS NO SB
    public static function getGames($where = null, $order = null, $limit = null)
    {
        return (new Database('games'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    //METODO PARA OBTER A QUANTIDADE DE JOGOS NO DB
    public static function getQuantidadeGames($where = null)
    {
        return (new Database('games'))->select($where, null, null, 'COUNT(*) as qtd')
            ->fetchObject()
            ->qtd;
    }

    //METODO PARA BUSCAR UM JOGO NO DB COM BASE NO ID
    public static function getGame($id)
    {
        return (new Database('games'))->select('id = ' . $id)
            ->fetchObject(self::class);
    }
}
