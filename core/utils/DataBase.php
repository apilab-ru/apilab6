<?php

namespace core\utils;

class DataBase{
    
    public $db;
    
    function __construct($param){
        /*include __DIR__ ."/../libs/DbSimple/SqlLite.php";
        $this->db = new \DbSimple_Sqlite("mysql://{$param['user']}:{$param['pass']}@{$param['host']}/{$param['table']}");
        $this->db->query("SET NAMES UTF8");*/
    }
    
    function select(){
        $args = func_get_args();
        $res = call_user_func_array([$this->db,'select'], $args);
        return $res;
    }
    
    function query(){
        $args = func_get_args();
        $res = call_user_func_array([$this->db,'query'], $args);
        return $res;
    }
    
    function insert($table,$row){
        return $this->db->query('insert into `$table` (?#) values (?a)',array_keys($row),array_values($row));
    }
}
