<?php

namespace App\Db;

use \PDO;
use PDOException;

class Database
{
    //CONSTANTES DA CONEXAO COM O DB
    const HOST = 'localhost';
    const NAME = 'crud_games';
    const USER = 'root';
    const PASS = '';

    //DADOS DA TABELA A SER MANIPULADA POR QUERY BUILDER
    private $table;

    //INSTANCIA DE CONEXAO COM DB (PDO)
    private $connection;

    //CONSTRUTOR DA TABELA E INSTANCIA A CONEXAO
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    //METODO PARA CRIAR CONEXAO COM DB
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    //METODO PARA EXECUTAR QUERIES NO DB
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    //METODO PARA INSERIR DADOS NO DB
    public function insert($values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        //MONTA A QUERY
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        //EXECUTA O INSERT
        $this->execute($query, array_values($values));

        //RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
    }

    //METODO PARA EXECUTAR CONSULTA NO DB
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = 'SELECT ' . $fields .  ' FROM ' . $this->table . ' ' . $where . ' ' . $limit;

        //RETORNA SUCESSO
        return $this->execute($query);
    }

    //METODO PARA EXECUTAR ATUALIZACOES NO DB
    public function update($where, $values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);

        //MONTA A QUERY
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;

        //EXECUTA QUERY
        $this->execute($query, array_values($values));

        //RETORNA SUCESSO
        return true;
    }

    //METODO PARA EXCLUIR DADOS DO DB
    public function delete($where)
    {
        //MONTA QUERY
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;

        //EXECUTA QUERY
        $this->execute($query);

        //RETORNA SUCESSO

        return true;
    }
}
