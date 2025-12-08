<?php

namespace App\Models;

use CodeIgniter\Model;

class ChambreModel extends Model
{
    protected $table            = 'chambres';
    protected $primaryKey       = 'id_chambre';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nom', 'capacite', 'description', 'prix_par_nuit', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'nom'            => 'required|min_length[3]|max_length[100]',
        'capacite'       => 'required|numeric|greater_than[0]|less_than_equal_to[10]',
        'description'    => 'permit_empty|max_length[500]',
        'prix_par_nuit'  => 'required|numeric|greater_than[0]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    /**
     * Get available rooms for a date range
     */
    public function getAvailableRooms($date_debut, $date_fin)
    {
        return $this->select('chambres.*')
                    ->whereNotIn('id_chambre', function($builder) use ($date_debut, $date_fin) {
                        return $builder->select('id_chambre')
                                      ->from('reservations')
                                      ->where('statut !=', 'annulee')
                                      ->where('date_fin >', $date_debut)
                                      ->where('date_debut <', $date_fin);
                    })
                    ->findAll();
    }

    /**
     * Get room with reservation count for a period
     */
    public function getRoomWithReservations($id_chambre)
    {
        $room = $this->find($id_chambre);
        if (!$room) return null;

        $reservationModel = new ReservationModel();
        $room['reservations'] = $reservationModel->where('id_chambre', $id_chambre)
                                                   ->where('statut !=', 'annulee')
                                                   ->findAll();

        return $room;
    }
}
