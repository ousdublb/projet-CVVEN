<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table            = 'clients';
    protected $primaryKey       = 'id_client';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'nom', 'prenom', 'telephone', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'id_user'   => 'required|numeric',
        'nom'       => 'required|min_length[2]|max_length[50]',
        'prenom'    => 'required|min_length[2]|max_length[50]',
        'telephone' => 'required|regex_match[/^[0-9\+\-\s\(\)]+$/]|min_length[10]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Relations
    protected $userModel;

    /**
     * Get client with user information
     */
    public function getClientWithUser($id_client)
    {
        return $this->select('clients.*, users.email, users.role')
                    ->join('users', 'users.id_user = clients.id_user')
                    ->find($id_client);
    }

    /**
     * Get all clients with user information
     */
    public function getAllClientsWithUser()
    {
        return $this->select('clients.*, users.email, users.role')
                    ->join('users', 'users.id_user = clients.id_user')
                    ->findAll();
    }
}
