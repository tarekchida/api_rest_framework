<?php

namespace App\Controllers;

/**
 * Description of SongsController
 *
 * @author Tarek.Chida
 */
use Lib\BaseController;
use Lib\Request;
use App\Models\Song;

class SongsController extends BaseController {

    function __construct() {
        
    }

    /**
     * Get song by Id Action
     * @param Request $request
     * @return type
     */
    public function get(Request $request) {
        $id = $request->getInput('id');
        if ($song = Song::find($id)) {
            return $this->response(API_SUCCESS, '', $song);
        }
        return $this->response(API_NOT_FOUND, 'Song not Found', $request->getInputArray());
    }

}
