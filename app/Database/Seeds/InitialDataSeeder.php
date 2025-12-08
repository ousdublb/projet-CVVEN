<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $userData = [
            'email' => 'admin@hotel.com',
            'mot_de_passe' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($userData);

        // Create sample chambres
        $chambres = [
            [
                'nom' => 'Chambre Standard',
                'capacite' => 2,
                'description' => 'Chambre confortable pour 2 personnes avec lit double, salle de bain privée.',
                'prix_par_nuit' => 79.99,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Chambre Deluxe',
                'capacite' => 3,
                'description' => 'Chambre spacieuse avec lit king-size et canapé, vue panoramique.',
                'prix_par_nuit' => 129.99,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Suite',
                'capacite' => 4,
                'description' => 'Suite luxueuse avec chambre à coucher séparée, salon et minibar.',
                'prix_par_nuit' => 199.99,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Chambre Économique',
                'capacite' => 1,
                'description' => 'Petite chambre idéale pour les voyageurs solo.',
                'prix_par_nuit' => 49.99,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($chambres as $chambre) {
            $this->db->table('chambres')->insert($chambre);
        }
    }
}
