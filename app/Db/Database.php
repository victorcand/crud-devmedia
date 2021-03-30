<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database
{
    const HOST = "localhost";
    const USERNAME = "root";
    const PASS = "";
    const DBNAME = "devmedia";

    /**
     * Nome da tabela a ser manipulada
     *
     * @var [type]
     */
    private $table;

    /**
     * Instancia de conexão com o banco de dados
     *
     * @var PDO
     */
    private $connection;

    /**
     * Define a tabela e instancia a conexão
     *
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Metodo responsavel por criar uma conexão com o banco de dados
     *
     * @return void
     */
    public function setConnection()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';dbname=' . self::DBNAME,
                self::USERNAME,
                self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Método responsavel por executar queries dentro do banco de dados.
     *
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Metodo responsavel por inserir dados no banco.
     *
     * @param array $values [field => value]
     * @return integer
     */
    public function insert($values)
    {
        //DADOS DA QUERY

        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        //MONTAR QUERY
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        //EXECUTA O INSERT
        $this->execute($query, array_values($values));

        //RETORNAR O ID INSERIDO
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsavel por executar uma consulta no banco
     *
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //DADOS DA QUERRY
        $where = strlen($where) ? "WHERE " . $where : '';
        $order = strlen($order) ? "ORDER BY " . $order : '';
        $limit = strlen($limit) ? "LIMIT " . $limit : '';

        //MONTA QUERRY
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        //EXECUTA QUERY
        return $this->execute($query);
    }

    /**
     * Metodo responsavel por executar atualizações no banco de dados
     *
     * @param string $where
     * @param array $values [field => value]
     * @return boolean
     */
    public function update($where, $values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);

        //MONTA QUERY
        $query = 'UPDATE ' . $this->table . ' SET '.implode('=?,',$fields).'=? WHERE ' . $where;
        
        //EXECUTAR A QUERY
        $this->execute($query, array_values($values));

        //RETORNA SUCESSO
        return true;

    }

    /**
     * Metodo responsavel por excluir no banco de dados
     *
     * @param string $where
     * @return boolean
     */
    public function delete($where)
    {
        //MONTA A QUERY
        $query = 'DELETE from '.$this->table.' WHERE ' .$where; 
    
        //EXECUTA A QUERY
        $this->execute($query);

        //RETORNA SUCESSO
        return true;
    }

}
