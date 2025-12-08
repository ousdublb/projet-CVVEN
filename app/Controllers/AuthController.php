<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClientModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $userModel;
    protected $clientModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->clientModel = new ClientModel();
        $this->session = session();
    }

    /**
     * Show login form
     */
    public function loginForm()
    {
        return view('auth/login');
    }

    /**
     * Handle login
     */
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('mot_de_passe');

        // Validation
        if (!$this->validate([
            'email' => 'required|valid_email',
            'mot_de_passe' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Find user
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect.');
        }

        // Verify password
        if (!password_verify($password, $user['mot_de_passe'])) {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect.');
        }

        // Set session
        $this->session->set([
            'id_user' => $user['id_user'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true
        ]);

        // Get client info if user is client
        if ($user['role'] === 'client') {
            $client = $this->clientModel->where('id_user', $user['id_user'])->first();
            if ($client) {
                $this->session->set('id_client', $client['id_client']);
            }
        }

        return redirect()->to(base_url('dashboard'));
    }

    /**
     * Show registration form
     */
    public function registerForm()
    {
        return view('auth/register');
    }

    /**
     * Handle registration
     */
    public function register()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'mot_de_passe' => $this->request->getPost('mot_de_passe'),
            'mot_de_passe_confirm' => $this->request->getPost('mot_de_passe_confirm'),
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'telephone' => $this->request->getPost('telephone')
        ];

        // Validation
        if (!$this->validate([
            'email' => 'required|valid_email|is_unique[users.email]',
            'mot_de_passe' => 'required|min_length[6]|matches[mot_de_passe_confirm]',
            'mot_de_passe_confirm' => 'required',
            'nom' => 'required|min_length[2]',
            'prenom' => 'required|min_length[2]',
            'telephone' => 'required|min_length[10]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Create user
        $userData = [
            'email' => $data['email'],
            'mot_de_passe' => $data['mot_de_passe'],
            'role' => 'client'
        ];

        $id_user = $this->userModel->insert($userData);

        if (!$id_user) {
            return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement.');
        }

        // Create client profile
        $clientData = [
            'id_user' => $id_user,
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'telephone' => $data['telephone']
        ];

        $this->clientModel->insert($clientData);

        return redirect()->to(base_url('login'))->with('success', 'Inscription réussie. Veuillez vous connecter.');
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Vous avez été déconnecté.');
    }
}
