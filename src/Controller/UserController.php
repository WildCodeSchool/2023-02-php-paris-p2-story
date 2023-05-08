<?php

namespace App\Controller;

use App\Model\UserManager;
use Error;

class UserController extends AbstractController
{
    public function login(): string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);

            if (!isset($credentials['name']) || empty($credentials['name'])) {
                $errors[] = "Merci d'indiquer un nom d'utilisateur";
            }
            $userManager = new UserManager();
            $user = $userManager->selectOneByName($credentials['name']);

            if (!isset($credentials['password']) || empty($credentials['password'])) {
                $errors[] = "Merci d'indiquer un mot de passe";
            }

            if ($user && ($credentials['password'] === $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                // var_dump($_SESSION);
                // exit();
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
