<?php
class DB {
    public $conn_string;
    public $db_user;
    public $db_passw;

    private $_connection;

    public function query($sql){
        $conn = $this->getConnection();

        if(empty($sql)){
            return;
        }
        $res = [];
        foreach($conn->query($sql, PDO::FETCH_ASSOC) as $row){
            $res[] = $row;
        }
        return $res;
    }
    
    public function getConnection(){
        if($this->_connection === null){
            $this->_connection = new PDO(
                $this->conn_string,
                $this->db_user,
                $this->db_passw
            );
        }
        return $this->_connection;
    }
}