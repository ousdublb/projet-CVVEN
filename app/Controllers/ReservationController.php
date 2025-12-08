<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\ChambreModel;
use CodeIgniter\Controller;

class ReservationController extends Controller
{
    protected $reservationModel;
    protected $chambreModel;
    protected $session;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
        $this->chambreModel = new ChambreModel();
        $this->session = session();
    }

    /**
     * Show booking form for a specific room
     */
    public function bookingForm($id_chambre)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'client') {
            return redirect()->to(base_url('login'));
        }

        $chambre = $this->chambreModel->find($id_chambre);
        if (!$chambre) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Chambre non trouvée');
        }

        $data = [
            'chambre' => $chambre,
            'date_debut' => $this->request->getGet('date_debut'),
            'date_fin' => $this->request->getGet('date_fin')
        ];

        return view('reservations/form', $data);
    }

    /**
     * Create reservation
     */
    public function create()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'client') {
            return redirect()->to(base_url('login'));
        }

        $id_client = $this->session->get('id_client');
        $data = [
            'id_client' => $id_client,
            'id_chambre' => $this->request->getPost('id_chambre'),
            'date_debut' => $this->request->getPost('date_debut'),
            'date_fin' => $this->request->getPost('date_fin'),
            'nb_personnes' => $this->request->getPost('nb_personnes'),
            'statut' => 'en_attente'
        ];

        if (!$this->validate([
            'id_chambre' => 'required|numeric',
            'date_debut' => 'required|valid_date[Y-m-d]',
            'date_fin' => 'required|valid_date[Y-m-d]',
            'nb_personnes' => 'required|numeric|greater_than[0]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check if room is available
        if (!$this->reservationModel->isRoomAvailable($data['id_chambre'], $data['date_debut'], $data['date_fin'])) {
            return redirect()->back()->with('error', 'La chambre n\'est pas disponible pour ces dates.');
        }

        // Check capacity
        $chambre = $this->chambreModel->find($data['id_chambre']);
        if ($data['nb_personnes'] > $chambre['capacite']) {
            return redirect()->back()->with('error', 'Le nombre de personnes dépasse la capacité de la chambre.');
        }

        $this->reservationModel->insert($data);

        return redirect()->to(base_url('client/reservations'))->with('success', 'Réservation créée avec succès.');
    }

    /**
     * View reservation details
     */
    public function detail($id_reservation)
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $reservation = $this->reservationModel->getReservationDetails($id_reservation);
        if (!$reservation) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Réservation non trouvée');
        }

        // Check authorization
        if ($this->session->get('role') === 'client' && $reservation['id_client'] !== $this->session->get('id_client')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Accès refusé');
        }

        $data = [
            'reservation' => $reservation
        ];

        return view('reservations/detail', $data);
    }

    /**
     * Cancel reservation
     */
    public function cancel($id_reservation)
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $reservation = $this->reservationModel->find($id_reservation);
        if (!$reservation) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Réservation non trouvée');
        }

        // Check authorization
        if ($this->session->get('role') === 'client' && $reservation['id_client'] !== $this->session->get('id_client')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Accès refusé');
        }

        $this->reservationModel->update($id_reservation, ['statut' => 'annulee']);

        return redirect()->to(base_url('client/reservations'))->with('success', 'Réservation annulée avec succès.');
    }

    /**
     * Confirm reservation (Admin only)
     */
    public function confirm($id_reservation)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $this->reservationModel->update($id_reservation, ['statut' => 'confirmee']);

        return redirect()->back()->with('success', 'Réservation confirmée.');
    }
}
