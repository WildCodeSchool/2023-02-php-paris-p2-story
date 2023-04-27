<?php

namespace App\Controller;

use App\Model\StoryManager;

class StoryController extends AbstractController
{
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
    public function show(int $id): string
    {
        $storyManager = new StoryManager();
        $story = $storyManager->selectOneById($id);

        return $this->twig->render('Story/show.html.twig', ['story' => $story]);
    }

    /**
     * Edit a specific story
     */

    /*
     public function edit(int $id): ?string
    {

        $storyManager = new StoryManager();
        $story = $storyManager->selectOneById($id);

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $story = array_map('trim', $_POST);

            if ((!isset($story['title'])) || (empty($story['title']))) {
                $errors[] = "Dommage que votre histoire n'ait pas de titre ! ";
            } elseif (strlen($story['title']) > 100) {
                $errors[] = "Le titre de votre histoire est trop long";
            }

            if ((!isset($story['pseudo'])) || (empty($story['pseudo']))) {
                $errors[] = "Merci de renseigner votre nom de plume.";
            } elseif (strlen($story['pseudo']) > 100) {
                $errors[] = "Votre nom de plume est un peu trop long.";
            }

            if (!isset($story['nbchapter']) || empty($story['nbchapter'])) {
                $errors[] = "Merci d'indiquer le nombre de chapitres total de votre histoire.";
            }

            if (isset($story['genre']) == "Choisissez un genre") {
                $errors[] = "Merci de choisir un genre parmi ceux proposés.";
            }

            if ((!empty($story['description'])) && (strlen($story['description']) < 400)) {
                $errors[] = "Pour la description, merci de vous limite";
            } elseif ((!empty($story['description'])) && (strlen($story['description']) > 2000)) {
                $errors[] = "Pour la description, merci de vous limiter à un texte entre 400 et 2000 caractères.";
            }

            if (!isset($story['lectorat'])) {
                $errors[] = "Merci d'indiquer si votre histoire convient à tous les publics.";
            }

            // if validation is ok, update and redirection
            $storyManager->update($story);

            // erreur dans le header??
            header('Location: /stories/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;

            return $this->twig->render('Story/edit.html.twig', [
            'story' => $story,
        ]);
        }
    */

    /**
     * Add a new story
     */
    public function verify($story)
    {
        $errors = [];

        if ((!isset($story['title'])) || (empty($story['title']))) {
            $errors[] = "Dommage que votre histoire n'ait pas de titre !";

            if ((!isset($story['pseudo'])) || (empty($story['pseudo']))) {
                $errors[] = "Merci de renseigner votre nom de plume.";
            }

            if (!isset($story['nbchapter']) || empty($story['nbchapter'])) {
                $errors[] = "Merci d'indiquer le nombre de chapitres total de votre histoire.";
            }

            if (isset($story['genre']) == "Choisissez un genre") {
                $errors[] = "Merci de choisir un genre parmi ceux proposés.";
            }

            if (!isset($story['lectorat'])) {
                $errors[] = "Merci d'indiquer si votre histoire convient à tous les publics.";
            }
            return $errors;
        }
    }

    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $story = array_map('trim', $_POST);
            $errors = $this->verify($story);
            if (empty($errors)) {
                // if validation is ok, insert and redirection
                $storyManager = new StoryManager();
                $id =  $storyManager->insert($story);

                // erreur dans le header??
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
