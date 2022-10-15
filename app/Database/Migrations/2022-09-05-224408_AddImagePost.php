<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImagePost extends Migration
{
    public function up()
    {

        $fields = [
            'post_image' =>
            [
                'type' => 'varchar',
                'constraint' => 128,
                'DEFAULT' => "default.png"
            ],
        ];
        $this->forge->addColumn('post', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('post', 'post_image');
    }
}
