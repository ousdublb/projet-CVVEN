<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TestController extends Controller
{
    /**
     * Test database connection
     */
    public function testDatabase()
    {
        try {
            $db = \Config\Database::connect();
            
            // Try a simple query
            $result = $db->query('SELECT 1')->getResult();

            $output = [
                'status' => 'success',
                'message' => 'Connexion à la base de données réussie!',
                'database' => $db->getDatabase(),
                'driver' => $db->DBDriver
            ];

            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            $output = [
                'status' => 'error',
                'message' => 'Erreur de connexion: ' . $e->getMessage()
            ];

            return $this->response->setJSON($output)->setStatusCode(500);
        }
    }

    /**
     * Check tables existence
     */
    public function checkTables()
    {
        try {
            $db = \Config\Database::connect();

            $requiredTables = ['users', 'clients', 'chambres', 'reservations'];
            $results = [];

            foreach ($requiredTables as $table) {
                $exists = $db->tableExists($table);
                $results[$table] = $exists ? 'OK' : 'MISSING';
            }

            return $this->response->setJSON([
                'status' => 'success',
                'tables' => $results
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
