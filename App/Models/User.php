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

    protected static $table = 'user';

    public static function find($id) {
        
    }

}
