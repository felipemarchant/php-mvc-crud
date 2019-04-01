<?php

class Messages {

    private $table = 'messages';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function all() {
        $query = " SELECT * FROM {$this->table}; ";
        return $this->db->query($query)
                        ->all();
    }   

    public function one($id) {
        return $this->db->query("SELECT * FROM {$this->table} WHERE id = :id")
                        ->bind(':id', $id, PDO::PARAM_INT)
                        ->one();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id")
                 ->bind(':id', $id, PDO::PARAM_INT)
                 ->execute();
    }

    public function insert($data) {
        $columns = array_keys($data);

        $columnsQuery   = "`". implode("`,`", $columns) ."`";
        $valueBindQuery = ":". implode(",:", $columns);

        $query  = " INSERT INTO {$this->table} ";
        $query .= " ({$columnsQuery}) ";
        $query .= " VALUE ({$valueBindQuery}); ";

        $this->db->query($query);

        foreach ($data as $key => $valueOfBind) {
            $this->db->bind(":{$key}", $valueOfBind);
        }

        $this->db->execute();

    }

    public function update($data, $dataWhere) {
        $dataQuery = '';
        $dataQueryBinding = '';
        
        foreach ($data as $key => $value) {
            $dataQuery .= "`{$key}`='{$value}', ";
        }
        $dataQuery = trim($dataQuery, ', ');
        
        foreach ($dataWhere as $key => $value) {
            $dataQueryBinding .= "AND `{$key}`= :{$key} ";
        }
        $dataQueryBinding = ltrim($dataQueryBinding, "AND");


        $query  = " UPDATE {$this->table} ";
        $query .= " SET {$dataQuery}";
        $query .= " WHERE {$dataQueryBinding};";

        $this->db->query($query);
        
        foreach ($dataWhere as $key => $value) {
           $this->db->bind(":{$key}", $value);
        }
        
        $this->db->execute();

    }
}