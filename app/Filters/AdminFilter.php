<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    /**
     * Verify if user is admin
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Vous devez vous connecter.');
        }

        if ($session->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Accès refusé. Droits administrateur requis.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing
    }
}
