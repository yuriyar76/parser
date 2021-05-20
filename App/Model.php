<?php

namespace App;

use App;

abstract class Model
{

    protected const TABLE = '';

    public $id;

    public static function findAll(): array
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query($sql, static::class);
    }

    public static function findById($id)
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $data = $db->query($sql, static::class, [':id' => $id]);
        return empty($data) ? null : $data[0];
    }

    public function insert()
    {
        $props = get_object_vars($this);
       // echo '<pre>' . print_r($props, false) . '</pre>';
        $columns = [];
        $binds = [];
        $data = [];
        foreach ($props as $name => $value) {
            if($name === 'id') continue;
            $columns[] = $name;
            $binds[] = ':' . $name;
            $data[':' . $name] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' 
        (' . implode(',', $columns) . ') 
        VALUES (' . implode(',', $binds) . ' )';

        $db = Db::instance();
        $db->execute($sql, $data);

    }

}
