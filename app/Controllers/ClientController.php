<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\ReservationModel;
use CodeIgniter\Controller;

class ClientController extends Controller
{
    protected $clientModel;
    protected $reservationModel;
    protected $session;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
        $this->reservationModel = new ReservationModel();
        $this->session = session();
    }

    /**
     * Client dashboard
     */
    public function dashboard()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'client') {
            return redirect()->to(base_url('login'));
        }

        $id_client = $this->session->get('id_client');
        $data = [
            'client' => $this->clientModel->find($id_client),
            'reservations' => $this->reservationModel->getClientReservations($id_client)
        ];

        return view('clients/dashboard', $data);
    }

    /**
     * Show client profile edit form
     */
    public function editProfile()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'client') {
            return redirect()->to(base_url('login'));
        }

        $id_client = $this->session->get('id_client');
        $data = [
            'client' => $this->clientModel->find($id_client)
        ];

        return view('clients/edit_profile', $data);
    }

    /**
     * Update client profile
     */
    public function updateProfile()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'client') {
            return redirect()->to(base_url('login'));
        }

        $id_client = $this->session->get('id_client');
        $data = [
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'telephone' => $this->request->getPost('telephone')
        ];

        // Validation
        if (!$this->validate([
            'nom' => 'required|min_length[2]',
            'prenom' => 'required|min_length[2]',
            'telephone' => 'required|min_length[10]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->clientModel->update($id_client, $data);

        return redirect()->to(base_url('client/dashboard'))->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * View client reservations
     */
    public function viewReservations()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'client') {
            return redirect()->to(base_url('login'));
        }

        $id_client = $this->session->get('id_client');
        $data = [
            'reservations' => $this->reservationModel->getClientReservations($id_client)
        ];

        return view('clients/reservations', $data);
    }
}
