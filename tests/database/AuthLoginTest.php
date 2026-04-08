<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\UserModel;

final class AuthLoginTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $userModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userModel = new UserModel();
    }

    /**
     * Test que le mot de passe est hashé avant stockage
     */
    public function testPasswordIsHashedBeforeStorage(): void
    {
        $plainPassword = 'test_password_123';
        
        // Insérer un utilisateur
        $userId = $this->userModel->insert([
            'email' => 'test@hotel.com',
            'mot_de_passe' => $plainPassword,
            'role' => 'client'
        ]);

        // Récupérer l'utilisateur depuis la base
        $user = $this->userModel->find($userId);

        // Vérifier que le mot de passe stocké n'est PAS en clair
        $this->assertNotSame($plainPassword, $user['mot_de_passe']);
        
        // Vérifier que c'est un hash bcrypt valide
        $this->assertTrue(password_verify($plainPassword, $user['mot_de_passe']));
    }

    /**
     * Test que password_verify() retourne true avec le bon mot de passe
     */
    public function testPasswordVerifySucceedsWithCorrectPassword(): void
    {
        $plainPassword = 'correct_password';
        $wrongPassword = 'wrong_password';

        $userId = $this->userModel->insert([
            'email' => 'user@hotel.com',
            'mot_de_passe' => $plainPassword,
            'role' => 'admin'
        ]);

        $user = $this->userModel->find($userId);

        // Bon mot de passe
        $this->assertTrue(password_verify($plainPassword, $user['mot_de_passe']));
        
        // Mauvais mot de passe
        $this->assertFalse(password_verify($wrongPassword, $user['mot_de_passe']));
    }

    /**
     * Test du processus complet de connexion
     */
    public function testLoginWithHashedPassword(): void
    {
        $email = 'login@hotel.com';
        $password = 'my_secure_password';

        // Créer un utilisateur
        $this->userModel->insert([
            'email' => $email,
            'mot_de_passe' => $password,
            'role' => 'client'
        ]);

        // Simuler la logique de connexion
        $user = $this->userModel->where('email', $email)->first();
        
        $this->assertNotNull($user);
        $this->assertTrue(password_verify($password, $user['mot_de_passe']));
    }
}