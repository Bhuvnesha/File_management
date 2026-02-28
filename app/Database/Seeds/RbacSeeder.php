<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RbacSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('roles')->insertBatch([
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'viewer'],
        ]);

        $this->db->table('permissions')->insertBatch([
            ['name' => 'upload_file'],
            ['name' => 'delete_file'],
            ['name' => 'download_file'],
            ['name' => 'view_analytics'],
            ['name' => 'create_backup'],
        ]);
    }
}
