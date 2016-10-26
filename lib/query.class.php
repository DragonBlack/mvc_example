<?php
class Query {
    protected $_select = [];
    protected $_from;
    protected $_where;
    protected $_params = [];
    protected $_sql;

    /** @var  PDO */
    private $_conn;

    public function __construct(){
        $this->_select = $this->_params = [];
        $this->_from = $this->_where = $this->_sql = null;
        $this->_conn = App::Component('db')->getConnection();
    }

    public function select($fields){
        if(is_string($fields)){
            $fields = explode(',', $fields);
            $fields = array_filter($fields);
        }
        $this->_select = $fields;
        return $this;
    }

    public function from($tableName){
        $this->_from = (string)$tableName;
        return $this;
    }

    public function where($condition, $params=[]){
        $this->_where = (string)$condition;
        $this->_params = $params;
        return $this;
    }

    public function one(){
        $this->_build();
        $stmt = $this->_conn->prepare($this->_sql);
        $this->_buildValues($stmt);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function _build(){
        $this->_sql = 'SELECT '.implode(', ', $this->_select).' ';
        $this->_sql .= 'FROM '.$this->_from.' ';
        if(!empty($this->_where)){
            $this->_sql .= ' WHERE '.$this->_where.' ';
        }
    }

    protected  function _buildValues(PDOStatement &$stmt){
        foreach ($this->_params as $key=>$val){
            $stmt->bindValue($key, $val);
        }
    }
}