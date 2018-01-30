<?php

namespace App\Models;

/**
 * Description of Song
 *
 * @author Tarek.Chida
 */
use Lib\BaseModel;
use PDO;

class Playlist extends BaseModel {

    protected static $table = 'playlists';

    public static function find($id) {
        $db = static::getDB();
        $query = $db->query('SELECT * FROM ' . self::$table . ' WHERE id=' . $id);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findByUser($id) {
        $db = static::getDB();
        $query = $db->query('SELECT id, name FROM ' . self::$table . ' WHERE user_id= ' . $id);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}
