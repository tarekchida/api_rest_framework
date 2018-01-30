<?php

namespace App\Models;

/**
 * Description of Song
 *
 * @author Tarek.Chida
 */
use Lib\BaseModel;
use PDO;

class Song extends BaseModel {

    protected static $table = 'songs';

    public static function find($id) {
        $db = static::getDB();
        $query = $db->query('SELECT * FROM ' . self::$table . ' WHERE id=' . $id);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
