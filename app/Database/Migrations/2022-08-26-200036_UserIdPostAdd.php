<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserIdPostAdd extends Migration
{
    public function up()
    {
        $fields=  ['user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
           
        ], 'CONSTRAINT post_user_id_fk FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE'

];
$this->forge->addColumn('post',$fields);

}
    public function down()
    {
        $this->forge->dropColumn('post', 'user_id');
    }
}
