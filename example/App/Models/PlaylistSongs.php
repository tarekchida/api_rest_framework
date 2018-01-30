<?php

namespace App\Models;

/**
 * Description of Song
 *
 * @author Tarek.Chida
 */
use Lib\BaseModel;
use PDO;

class PlaylistSongs extends BaseModel {

    protected static $table = 'playlist_songs';

    /**
     * find song in playlist
     * @param type $playlist_id
     * @param type $song_id
     * @return type
     */
    public static function find($playlist_id, $song_id = NULL) {
        $db = static::getDB();

        $sql = 'SELECT PL.id, PL.song_id, PL.order, SG.name, SG.duration'
                . ' FROM playlist_songs AS PL, songs AS SG'
                . ' WHERE PL.playlist_id=' . $playlist_id . ' AND PL.song_id=SG.id';
        if (!empty($song_id)) {
            $sql .= ' AND PL.song_id = ' . $song_id;
        }

        $sql .= ' ORDER BY PL.order ASC';

        $query = $db->query($sql);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add song to playlist
     * @param type $song_id
     * @param type $playlist_id
     * @return type
     */
    public static function add($song_id, $playlist_id) {
        $db = static::getDB();
        $query = $db->query('INSERT INTO ' . self::$table . '(song_id, playlist_id) '
                . 'VALUES(' . $song_id . ',' . $playlist_id . ')');
        return $query->execute();
    }

    /**
     * Remove song from playlist
     * @param type $song_id
     * @param type $playlist_id
     */
    public static function delete($song_id, $playlist_id) {
        $db = static::getDB();
        $query = $db->query('DELETE FROM ' . self::$table . ''
                . ' WHERE playlist_id = ' . $playlist_id . ' AND song_id = ' . $song_id);
        return $query->execute();
    }

}
