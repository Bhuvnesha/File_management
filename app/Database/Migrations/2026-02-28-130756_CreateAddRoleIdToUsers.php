<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAddRoleIdToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'role_id' => [
                'type' => 'INT',
                'null' => true,
                'after' => 'password',
            ],
        ]);

        $this->forge->addForeignKey('role_id', 'roles', 'id', 'SET NULL', 'CASCADE');
    }

    public function down() 
    {
        $this->forge->dropColumn('users', 'role_id');
    }
}
