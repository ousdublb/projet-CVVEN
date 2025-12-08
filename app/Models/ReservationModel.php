<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table            = 'reservations';
    protected $primaryKey       = 'id_reservation';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_client', 'id_chambre', 'date_debut', 'date_fin', 'statut', 'nb_personnes', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'id_client'   => 'required|numeric',
        'id_chambre'  => 'required|numeric',
        'date_debut'  => 'required|valid_date[Y-m-d]',
        'date_fin'    => 'required|valid_date[Y-m-d]',
        'statut'      => 'required|in_list[en_attente,confirmee,annulee]',
        'nb_personnes' => 'required|numeric|greater_than[0]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    /**
     * Get reservation with client and room details
     */
    public function getReservationDetails($id_reservation)
    {
        return $this->select('reservations.*, clients.nom, clients.prenom, users.email as client_email, chambres.nom as chambre_nom, chambres.prix_par_nuit')
                    ->join('clients', 'clients.id_client = reservations.id_client')
                    ->join('users', 'users.id_user = clients.id_user')
                    ->join('chambres', 'chambres.id_chambre = reservations.id_chambre')
                    ->find($id_reservation);
    }

    /**
     * Get all reservations with details
     */
    public function getAllReservationsWithDetails()
    {
        return $this->select('reservations.*, clients.nom, clients.prenom, users.email as client_email, chambres.nom as chambre_nom, chambres.prix_par_nuit')
                    ->join('clients', 'clients.id_client = reservations.id_client')
                    ->join('users', 'users.id_user = clients.id_user')
                    ->join('chambres', 'chambres.id_chambre = reservations.id_chambre')
                    ->findAll();
    }

    /**
     * Get client reservations
     */
    public function getClientReservations($id_client)
    {
        return $this->select('reservations.*, chambres.nom as chambre_nom, chambres.prix_par_nuit')
                    ->join('chambres', 'chambres.id_chambre = reservations.id_chambre')
                    ->where('reservations.id_client', $id_client)
                    ->findAll();
    }

    /**
     * Check if a room is available for date range
     */
    public function isRoomAvailable($id_chambre, $date_debut, $date_fin, $exclude_id = null)
    {
        $builder = $this->where('id_chambre', $id_chambre)
                       ->where('statut !=', 'annulee')
                       ->where('date_fin >', $date_debut)
                       ->where('date_debut <', $date_fin);

        if ($exclude_id) {
            $builder->where('id_reservation !=', $exclude_id);
        }

        return $builder->countAllResults() === 0;
    }
}
