<?php
class Model {
    public $id;

    public function load(array $data){
        $apply = false;
        foreach($data as $field=>$value){
            if(property_exists($this, $field)){
                $apply = true;
                $this->$field = $value;
            }
        }

        return $apply;
    }

    public static function find(array $condition = []){
        $fields = array_merge(['id'], static::attributes());
        $query = (new Query())->select($fields)
            ->from(static::$tableName);

        if(!empty($condition)){
            $where = array_shift($condition);
            $param = !empty($condition) ? $condition[0] : [];
            $query->where($where, $param);
        }

        return $query;
    }

}