<?php

require_once 'Db.php';

class Select extends Db
{
    public $fields;
    public $from;
    public $on;
    public $where;
    public $limit;

    public function __construct(string $fields = '*')
    {
        $this->fields = "SELECT $fields";
    }

    public function from(string $table) {
        $this->from = "FROM $table";
        return $this;
    }

    public function where($conditions)
    {
        $this->where = $this->clause('WHERE', $conditions);
        return $this;
    }
    
    public function on($conditions)
    {
        $this->on = $this->clause('ON', $conditions);
        return $this;
    }
    
    public function clause(string $prefix, ...$conditions)
    {
        $array[] = $prefix;
        foreach ($conditions as $condition) {
            $array[] = is_array($condition) ?
                implode(' ', $condition) :
                $condition;
        }
        return implode(' ', $array);
    }

    public function limit(int $limit = 1) {
        $this->limit = "LIMIT $limit";
        return $this;
    }

    public function fetch() {
       $sql = implode(' ', (array)$this);
       $db = self::initialize();
       $db->beginTransaction();
       $query = $db->prepare($sql);
       $db->commit();
       $query->execute();
       return $query->fetchAll(PDO::FETCH_OBJ);
    }
}