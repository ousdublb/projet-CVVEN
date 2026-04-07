<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImageToChambresTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('chambres', [
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
                'after' => 'prix_par_nuit',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('chambres', 'image');
    }
}
