<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_reservation' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_client' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_chambre' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'date_debut' => [
                'type' => 'DATE',
            ],
            'date_fin' => [
                'type' => 'DATE',
            ],
            'statut' => [
                'type' => 'ENUM',
                'constraint' => ['en_attente', 'confirmee', 'annulee'],
                'default' => 'en_attente',
            ],
            'nb_personnes' => [
                'type' => 'INT',
                'constraint' => 11,
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

        $this->forge->addPrimaryKey('id_reservation');
        $this->forge->addForeignKey('id_client', 'clients', 'id_client', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_chambre', 'chambres', 'id_chambre', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reservations');
    }

    public function down()
    {
        $this->forge->dropTable('reservations');
    }
}
