<?php
namespace app/core;

use PDO;
use PDOException;

abstract class BaseModel
{
    protected $db;

    public function __construct()
    {
        $config = require 'app/config/db.php';
        try {
            $this->db = new PDO(
                $config['provider'] . ':host' . $config['hostname'] . ';dbname=' . $config['database'],
                $config['username'],
                $config['password']
            );
        } catch (PDOException $ex) {
            echo 'Ошибка' . ex->getMassage() . '<br>';
            die();
        }
    }
    protected function query($sql, $params = [])
    {
        $query = $this->db->prepare($sql);
        if (!empty($params)){
            foreach ($params as $key => $val) {
                $query->bindValue(':' . $key, $val);
            }
        }
        $query->execute();
        return $query;
    }

}