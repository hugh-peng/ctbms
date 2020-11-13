<?php

class DataBase
{

    /**
     * @param string $target 查找范围
     * @param string $table 查找的表
     * @param string $cond 查找的条件
     * @param string $odd 查找的条件参数
     * @return string
     */
    public function find($target, $table ,$cond, $odd)
    {
        return "SELECT $target FROM $table WHERE ".$cond." = '$odd';";
    }

    public function insert()
    {

    }
}