<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    private UserManager $manager;

    public function __construct()
    {
        parent::__construct();
        $this->manager = new UserManager();
    }

    public function login(): string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);

            if (!isset($credentials['pseudo']) || empty($credentials['pseudo'])) {
                $errors[] = "Merci d'indiquer un nom d'utilisateur";
            }

            $user = $this->manager->selectOneByPseudo($credentials['pseudo']);

            if (!isset($credentials['password']) || empty($credentials['password'])) {
                $errors[] = "Merci d'indiquer un mot de passe";
            }

            if ($user && ($credentials['password'] === $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /');
                exit();
            } else {
                $errors[] = "Mot de passe incorrect";
            }
        }

        return $this->twig->render('User/login.html.twig', ['errors' => $errors]);
    }

    public function logout()
    {
        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
        }
        session_destroy();
        header('Location: /');
    }
}
