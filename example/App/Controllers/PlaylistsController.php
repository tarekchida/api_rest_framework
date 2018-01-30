<?php

namespace App\Controllers;

/**
 * Description of SongsController
 *
 * @author Tarek.Chida
 */
use Lib\BaseController;
use Lib\Request;
use App\Models\Playlist;
use App\Models\PlaylistSongs;
use App\Models\Song;

class PlaylistsController extends BaseController {

    function __construct() {
        
    }

    /**
     * Get playlist by user Id Action
     * @param Request $request
     * @return type
     */
    public function getByUser(Request $request) {
        $data = array();
        $id = $request->getInput('id', 0);

        //get user playlist id
        if ($playlist = Playlist::findByUser($id)) {
            $data['playlist'] = $playlist;

            //get songs list
            if ($playlistSongs = PlaylistSongs::find($playlist['id'])) {
                $data['songs'] = $playlistSongs;
            }
            return $this->response(API_SUCCESS, '', $data);
        }
        return $this->response(API_NOT_FOUND, 'Playlist Not found');
    }

    /**
     * Add song to playlist
     * @param Request $request
     * @return type
     */
    public function addSong(Request $request) {
        $song_id = $request->getInput('song_id', NULL);
        $playlist_id = $request->getInput('playlist_id', NULL);

        if (!empty($song_id) && !empty($playlist_id)) {

            //Check field exsistance 
            $this->songExists($song_id);
            $this->playlistExists($playlist_id);

            //Test if song already exists 
            if (PlaylistSongs::find($playlist_id, $song_id)) {
                return $this->response(API_ALREADY_EXISTS, 'Song already added to playlist', $request->getInputArray());
            }
            //Add song to playlist
            if (PlaylistSongs::add($song_id, $playlist_id)) {
                return $this->response(API_SUCCESS, 'Song added successfully', $this->getPlaylist($playlist_id));
            }
        }
        return $this->response(API_ERROR, 'Fields are missing', $request->getInputArray());
    }

    public function removeSong(Request $request) {
        $song_id = $request->getInput('song_id', NULL);
        $playlist_id = $request->getInput('playlist_id', NULL);

        if (!empty($song_id) && !empty($playlist_id)) {

            //Check field exsistance 
            $this->songExists($song_id);
            $this->playlistExists($playlist_id);

            //Test if song already exists 
            if (!PlaylistSongs::find($playlist_id, $song_id)) {
                return $this->response(API_NOT_FOUND, 'Song not found in playlist', $request->getInputArray());
            }
            //Add song to playlist
            if (PlaylistSongs::delete($song_id, $playlist_id)) {
                return $this->response(API_SUCCESS, 'Song removed successfully', $this->getPlaylist($playlist_id));
            }
        }
        return $this->response(API_ERROR, 'Fields are missing', $request->getInputArray());
    }

    /**
     * Check if song exists
     * @param type $id
     * @return type
     */
    private function songExists($id) {
        if (!Song::find($id)) {
            return $this->response(API_NOT_FOUND, 'Song Not found');
        }
    }

    /**
     * Check if playlist exsists 
     * @param type $id
     * @return type
     */
    private function playlistExists($id) {
        if (!Playlist::find($id)) {
            return $this->response(API_NOT_FOUND, 'Playlist Not found');
        }
    }

    /**
     * Get playlits songs
     * @param type $playlist_id
     * @return type
     */
    private function getPlaylist($playlist_id) {
        $data = array();
        if ($playlistSongs = PlaylistSongs::find($playlist_id)) {
            $data['playlist_id'] = $playlist_id;
            $data['songs'] = $playlistSongs;
        }
        return $data;
    }

}
