<?php
    class mysql {
        private $mysqlHost="127.0.0.1";
        private $mysqlDB="opt11";
        private $mysqlUser="root";
        private $mysqlPwd="";

        public function connect() {
            $mysqlCon=new PDO("mysql:host=$this->mysqlHost;port=3307;dbname=$this->mysqlDB",$this->mysqlUser,$this->mysqlPwd);
            $mysqlCon->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $mysqlCon;
        }
    }