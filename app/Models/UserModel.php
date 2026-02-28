<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name', 'email', 'password', 'role'];


    public function get_role($role_id)
    {
        $db = \Config\Database::connect();
        $row = $db->query("SELECT name from roles WHERE id = ?",array($role_id))->getRow();
        return $row->name;
    }

    
}