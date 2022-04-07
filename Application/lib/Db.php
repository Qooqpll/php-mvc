<?php

namespace Application\lib;

use PDO;

class Db
{

    protected $db;

    public function __construct()
    {
        $config = require 'Application/Config/Db.php';
        $this->db = new PDO('mysql:='. $config['host'] . ';dbname=' . $config['dbname'], $config['user'], $config['password']);
    }

    private function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if(!empty($params)) {
            foreach ($params as $key=>$val) {
                if(is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':'. $key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql);
        return $result->fetchColumn();
    }

    public function insert($sql)
    {
        $this->query($sql);
    }

}