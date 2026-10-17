<?php

namespace App\Models;

use PDO;
use PDOException;

class Model
{

    protected $servername;
    protected $dbname;
    protected $username;
    protected $password;
    protected $options;
    protected $connection;

    public function __construct()
    {

        $this->servername = SERVER_NAME;
        $this->dbname = DATABASE_NAME;
        $this->username = USER_NAME;
        $this->password = PASSWORD;
        $this->options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
    }

    public function connection(): PDO
    {
        return $this->connection = new PDO("sqlsrv:Server=$this->servername;Database=$this->dbname", $this->username, $this->password, $this->options);
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    protected function closeConnection(): void
    {
        $this->connection = null;
    }

    public function selectAll($sql, $values = null): false|array
    {
        try {
            $stmt = $this->connection()->prepare($sql);
            //print_r($stmt);
            if ($values === null) {
                $stmt->execute();
            } else {
                $stmt->execute($values);
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }


    }

    public
    function selectOne($sql, $values = null)
    {
        try {
            $stmt = $this->connection()->prepare($sql);
            if ($values === null) {
                $stmt->execute();
            } else {
                $stmt->execute($values);
            }
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public
    function update($query, $values = null)
    {
        try {
            $stmt = $this->connection()->prepare($query);
            if ($values === null) {
                return $stmt->execute();
            } else {
                return $stmt->execute($values);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

//$fields=[col1, col2] ,$values=[:col1, :col2]
    public
    function insert($tableName, $fields, $values)
    {
        try {
            $stmt = $this->connection()->prepare("INSERT INTO " . $tableName . "(" . implode(', ', $fields) . ") VALUES (:" . implode(', :', $fields) . ")");
            // echo $stmt->fetch(PDO::FETCH_ASSOC);
            return $stmt->execute(array_combine($fields, $values));//['$fields' => '$values']
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

    public
    function query($query, $values = null)
    {
        try {
            $stmt = $this->connection()->prepare($query);
            if ($values === null) {
                return $stmt->execute();
            } else {
                return $stmt->execute($values);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

//    public function sideBar($code)
//    {
//            $code = self::selectOne("SELECT tke FROM amehv_prd_person_edari11 WHERE pi_code=?", [$code]);
//            self::closeConnection();
//            if($code) return $code;
//    }

}