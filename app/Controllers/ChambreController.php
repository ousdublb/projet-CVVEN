<?php

namespace App\Controllers;

use App\Models\ChambreModel;
use CodeIgniter\Controller;

class ChambreController extends Controller
{
    protected $chambreModel;
    protected $session;

    public function __construct()
    {
        $this->chambreModel = new ChambreModel();
        $this->session = session();
    }

    /**
     * List all rooms
     */
    public function index()
    {
        $data = [
            'chambres' => $this->chambreModel->findAll()
        ];

        return view('chambres/list', $data);
    }

    /**
     * View room details
     */
    public function detail($id_chambre)
    {
        $room = $this->chambreModel->getRoomWithReservations($id_chambre);

        if (!$room) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Chambre non trouvée');
        }

        $data = [
            'chambre' => $room
        ];

        return view('chambres/detail', $data);
    }

    /**
     * Search available rooms (Admin & Client)
     */
    public function search()
    {
        $date_debut = $this->request->getGet('date_debut');
        $date_fin = $this->request->getGet('date_fin');

        if (!$date_debut || !$date_fin) {
            return redirect()->back()->with('error', 'Veuillez remplir les dates.');
        }

        $chambres = $this->chambreModel->getAvailableRooms($date_debut, $date_fin);

        $data = [
            'chambres' => $chambres,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ];

        return view('chambres/search_results', $data);
    }

    /**
     * Create room form (Admin only)
     */
    public function createForm()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        return view('chambres/create');
    }

    /**
     * Create new room (Admin only)
     */
    public function create()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'nom' => $this->request->getPost('nom'),
            'capacite' => $this->request->getPost('capacite'),
            'description' => $this->request->getPost('description'),
            'prix_par_nuit' => $this->request->getPost('prix_par_nuit')
        ];

        if (!$this->validate([
            'nom' => 'required|min_length[3]',
            'capacite' => 'required|numeric|greater_than[0]',
            'prix_par_nuit' => 'required|numeric|greater_than[0]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->chambreModel->insert($data);

        return redirect()->to(base_url('chambres'))->with('success', 'Chambre créée avec succès.');
    }

    /**
     * Edit room form (Admin only)
     */
    public function editForm($id_chambre)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $chambre = $this->chambreModel->find($id_chambre);
        if (!$chambre) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Chambre non trouvée');
        }

        $data = [
            'chambre' => $chambre
        ];

        return view('chambres/edit', $data);
    }

    /**
     * Update room (Admin only)
     */
    public function update($id_chambre)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'nom' => $this->request->getPost('nom'),
            'capacite' => $this->request->getPost('capacite'),
            'description' => $this->request->getPost('description'),
            'prix_par_nuit' => $this->request->getPost('prix_par_nuit')
        ];

        if (!$this->validate([
            'nom' => 'required|min_length[3]',
            'capacite' => 'required|numeric|greater_than[0]',
            'prix_par_nuit' => 'required|numeric|greater_than[0]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->chambreModel->update($id_chambre, $data);

        return redirect()->to(base_url('chambres'))->with('success', 'Chambre mise à jour avec succès.');
    }

    /**
     * Delete room (Admin only)
     */
    public function delete($id_chambre)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $this->chambreModel->delete($id_chambre);

        return redirect()->to(base_url('chambres'))->with('success', 'Chambre supprimée avec succès.');
    }
}
