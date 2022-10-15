<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActivationUser extends Migration
{
    public function up()
    {

        $fields = [
             'activation_hash' =>
            [
                'type' => 'VARCHAR',
                'CONSTRAINT' => 40
            ],
            'is_active' =>
            [
                'type' => 'BOOLEAN',
                'DEFAULT' => false
            ]
        ];
        $this->forge->addColumn('user', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('user', ['is_admin', 'activation_hash']);
    }
}
