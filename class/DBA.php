<?php

class DBA{
    private $pdo;
    
        public function __construct() {
            $this->pdo = new PDO('mysql:host=localhost;dbname=eshop','root','root',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }
    public function getPDO(){
        return $this->pdo;
    }
}
