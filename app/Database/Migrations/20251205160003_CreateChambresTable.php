<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateChambresTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_chambre' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'capacite' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'prix_par_nuit' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_chambre');
        $this->forge->createTable('chambres');
    }

    public function down()
    {
        $this->forge->dropTable('chambres');
    }
}
