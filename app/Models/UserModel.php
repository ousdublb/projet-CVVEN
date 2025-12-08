<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['email', 'mot_de_passe', 'role', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'email'         => 'required|valid_email|is_unique[users.email]',
        'mot_de_passe'  => 'required|min_length[6]',
        'role'          => 'required|in_list[admin,client]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    /**
     * Hash the password before inserting or updating
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['mot_de_passe'])) {
            $data['data']['mot_de_passe'] = password_hash($data['data']['mot_de_passe'], PASSWORD_DEFAULT);
        }

        return $data;
    }

    /**
     * Get user with client details
     */
    public function getUserWithClient($id_user)
    {
        return $this->select('users.*, clients.id_client, clients.nom, clients.prenom, clients.telephone')
                    ->join('clients', 'clients.id_user = users.id_user', 'left')
                    ->find($id_user);
    }
}
