<?php
class DB {
    public $conn_string;
    public $db_user;
    public $db_passw;

    private $_connection;

    public function query($sql, array $params=null){
        if(!$this->_connection){
            $this->_connection = new PDO(
                $this->conn_string,
                $this->db_user,
                $this->db_passw
            );
        }

        if(empty($sql)){
            return;
        }
        $res = $this->_connection->query($sql)->execute($params);
        return $res;
    }
}