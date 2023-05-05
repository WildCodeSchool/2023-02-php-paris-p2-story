<?php

namespace App\Controller;

use App\Model\StoryManager;

class StoryController extends AbstractController
{
    public const AUTHORIZED_EXTENSIONS = ['jpg', 'jepg', 'gif', 'png', 'webp'];
    public const MAX_FILE_SIZE = 2000000;
    public const UPLOAD_DIR = "../public/uploads/";
    public const DEFAULT_PICTURE = "default.png";

    /**
     * List stories
     */
    public function index(): string
    {
        $storyManager = new StoryManager();
        $stories = $storyManager->selectAll('title');

        return $this->twig->render('Story/index.html.twig', ['stories' => $stories]);
    }

    /**
     * Show informations for a specific story
     */
    // public function show(int $id): int
    // {
    //     $storyManager = new StoryManager();
    //     $story = $storyManager->selectOneById($id);

    //     return $this->twig->render('Story/show.html.twig', ['story' => $story]);
    // }
    /**
     * Edit a specific story
     */


    // public function edit(int $id): ?string
    // {

    //     $storyManager = new StoryManager();
    //     $story = $storyManager->selectOneById($id);

    //     $errors = [];

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $story = array_map('trim', $_POST);

    //         if ((!isset($story['title'])) || (empty($story['title']))) {
    //             $errors[] = "Dommage que votre histoire n'ait pas de titre ! ";
    //         } elseif (strlen($story['title']) > 100) {
    //             $errors[] = "Le titre de votre histoire est trop long";
    //         }

    //         if ((!isset($story['pseudo'])) || (empty($story['pseudo']))) {
    //             $errors[] = "Merci de renseigner votre nom de plume.";
    //         } elseif (strlen($story['pseudo']) > 100) {
    //             $errors[] = "Votre nom de plume est un peu trop long.";
    //         }

    //         if (!isset($story['nbchapter']) || empty($story['nbchapter'])) {
    //             $errors[] = "Merci d'indiquer le nombre de chapitres total de votre histoire.";
    //         }

    //         if (isset($story['genre']) == "Choisissez un genre") {
    //             $errors[] = "Merci de choisir un genre parmi ceux proposés.";
    //         }

    //         if ((!empty($story['description'])) && (strlen($story['description']) < 400)) {
    //             $errors[] = "Pour la description, merci de vous limite";
    //         } elseif ((!empty($story['description'])) && (strlen($story['description']) > 2000)) {
    //             $errors[] = "Pour la description, merci de vous limiter à un texte entre 400 et 2000 caractères.";
    //         }

    //         if (!isset($story['lectorat'])) {
    //             $errors[] = "Merci d'indiquer si votre histoire convient à tous les publics.";
    //         }

    //         // if validation is ok, update and redirection
    //         $storyManager->update($story);

    //         // erreur dans le header??
    //         header('Location: /stories/show?id=' . $id);

    //         // we are redirecting so we don't want any content rendered
    //         return null;

    //         return $this->twig->render('Story/edit.html.twig', [
    //             'story' => $story,
    //         ]);
    //     }
    // }

    /**
     * Add a new story
     */
    public function verify($story)
    {
        $errors = [];

        if (!isset($story['title']) || empty($story['title'])) {
            $errors[] = "Dommage que votre histoire n'ait pas de titre !";
        }

        if (!isset($story['pseudo']) || empty($story['pseudo'])) {
            $errors[] = "Merci de renseigner votre nom de plume.";
        }

        if (!isset($story['nbchapter']) || empty($story['nbchapter'])) {
            $errors[] = "Merci d'indiquer le nombre de chapitres total de votre histoire.";
        }

        if (!isset($story['genre']) == "Choisissez un genre") {
            $errors[] = "Merci de choisir un genre parmi ceux proposés.";
        }

        if (!isset($story['lectorat'])) {
            $errors[] = "Merci d'indiquer si votre histoire convient à tous les publics.";
        }

        if (file_exists($story['picture']['tmp_name'])) {
            $extension = pathinfo($story['picture']['name'], PATHINFO_EXTENSION);

            if (!in_array($extension, self::AUTHORIZED_EXTENSIONS)) {
                $errors[] = "Votre fichier doit être au format: jpg, jpeg, gif, png ou webp";
            }

            if (filesize($story['picture']['tmp_name']) > self::MAX_FILE_SIZE) {
                $errors[] = "Le poids de votre fichier doit peser moins de 2 Mega";
            }
        }

        return $errors;
    }

    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $story = array_merge(array_map('trim', $_POST), $_FILES);
            $errors = $this->verify($story);

            if (empty($errors)) {
                if (file_exists($story['picture']['tmp_name'])) {
                    $newFileName = uniqid('', true) . '.' . pathinfo($story['picture']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($story['picture']['tmp_name'], self::UPLOAD_DIR . $newFileName);
                    $story['picture'] = $newFileName;
                } else {
                    $story['picture'] = self::DEFAULT_PICTURE;
                }

                $storyManager = new StoryManager();
                $id =  $storyManager->insert($story);

                header('Location:/stories/show?id=' . $id);
                return null;
            }
        }

        return $this->twig->render('Story/add.html.twig');
    }

    /**
     * Delete a specific story
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $storyManager = new StoryManager();
            $storyManager->delete((int)$id);

            header('Location:/stories');
        }
    }
}
