<?php

namespace App\Models;

/**
 * Description of User
 *
 * @author Tarek.Chida
 */
use Lib\BaseModel;
use PDO;

class User extends BaseModel {

    protected static $table = 'users';

    public static function find($id) {
        $db = static::getDB();
        $query = $db->query('SELECT * FROM ' . self::$table . ' WHERE id=' . $id);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
