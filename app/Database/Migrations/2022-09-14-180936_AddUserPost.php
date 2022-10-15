<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserPost extends Migration
{
    public function up()
    {

        $fields = [
            'user_image' =>
            [
                'type' => 'varchar',
                'constraint' => 128,
                'DEFAULT' => "default.png"
            ],
        ];
        $this->forge->addColumn('user', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'user_image');
    }
}
