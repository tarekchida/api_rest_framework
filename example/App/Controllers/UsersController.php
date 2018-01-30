<?php

namespace App\Controllers;

/**
 * Description of UsersController
 *
 * @author Tarek.Chida
 */
use Lib\BaseController;
use Lib\Request;
use App\Models\User;

class UsersController extends BaseController {

    function __construct() {
        
    }

    /**
     * Get user by Id Action 
     * @param Request $request
     * @return type
     */
    public function get(Request $request) {
        $id = $request->getInput('id');

        if ($user = User::find($id)) {
            return $this->response(API_SUCCESS, '', $user);
        }
        return $this->response(API_NOT_FOUND, 'User not found', $request->getInputArray());
    }

}
