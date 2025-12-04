<?php 

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Core\Controller;
use App\Core\Notification;
use App\Core\Auth;
use App\Core\Validator;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        $this->view('auth/login', ['title' => 'Login']);
    }

    public function log()
    {   
        $validated = Validator::make($_POST, [
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
        ]);

        if (!$validated) {
            Notification::add('error', 'Données invalides. Veuillez vérifier les informations fournies.');
            header('Location: ' . url('/login'));
            exit();
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            
            $this->createSession($user);

            Notification::add("success", "Login successful!");
            header('Location: ' . url('/projects'));
            exit;

        } else {
            Notification::add("error", "Invalid email or password.");
            header('Location: ' . url('/login'));
            exit;
        }

    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . url('/login'));
        exit;
    }

    private function createSession($user)
    {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['name']
        ];
    }

    public function me()
    {
        $user = Auth::user();
        $this->view('auth/me', [
            'title' => 'My Profile',
            'user' => $user
        ]);
    }
}