<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\ChambreModel;
use App\Models\ReservationModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    protected $userModel;
    protected $clientModel;
    protected $chambreModel;
    protected $reservationModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clientModel = new ClientModel();
        $this->chambreModel = new ChambreModel();
        $this->reservationModel = new ReservationModel();
        $this->session = session();
    }

    /**
     * Admin dashboard
     */
    public function dashboard()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'total_users' => $this->userModel->countAllResults(),
            'total_clients' => $this->clientModel->countAllResults(),
            'total_chambres' => $this->chambreModel->countAllResults(),
            'total_reservations' => $this->reservationModel->countAllResults(),
            'reservations_en_attente' => $this->reservationModel->where('statut', 'en_attente')->countAllResults(),
            'reservations_confirmees' => $this->reservationModel->where('statut', 'confirmee')->countAllResults(),
            'recent_reservations' => $this->reservationModel->getAllReservationsWithDetails()
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * List all users
     */
    public function users()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'users' => $this->userModel->findAll()
        ];

        return view('admin/users', $data);
    }

    /**
     * List all clients
     */
    public function clients()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'clients' => $this->clientModel->getAllClientsWithUser()
        ];

        return view('admin/clients', $data);
    }

    /**
     * List all reservations
     */
    public function reservations()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'reservations' => $this->reservationModel->getAllReservationsWithDetails()
        ];

        return view('admin/reservations', $data);
    }

    /**
     * Update reservation status
     */
    public function updateReservationStatus($id_reservation)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $statut = $this->request->getPost('statut');

        if (!in_array($statut, ['en_attente', 'confirmee', 'annulee'])) {
            return redirect()->back()->with('error', 'Statut invalide.');
        }

        $this->reservationModel->update($id_reservation, ['statut' => $statut]);

        return redirect()->back()->with('success', 'Statut de la réservation mis à jour.');
    }

    /**
     * Delete user
     */
    public function deleteUser($id_user)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $this->userModel->delete($id_user);

        return redirect()->back()->with('success', 'Utilisateur supprimé.');
    }
}
