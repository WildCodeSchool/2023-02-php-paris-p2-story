<?php

namespace App\Controller;

use App\Model\StoryManager;
use App\Model\ChapterManager;

class StoryController extends AbstractController
{
    private ChapterManager $chapterManager;
    private StoryManager $storyManager;

    public const AUTHORIZED_EXTENSIONS = ['jpg', 'jepg', 'gif', 'png', 'webp'];
    public const MAX_FILE_SIZE = 2000000;
    public const UPLOAD_DIR = "../public/uploads/";
    public const DEFAULT_PICTURE = "../assets/images/default.png";

    public function __construct()
    {
        parent::__construct();
        $this->chapterManager = new ChapterManager();
        $this->storyManager = new StoryManager();
    }
    /**
     * List stories
     */
    public function cooperate()
    {
        $stories = $this->storyManager->selectAll();
        return $this->twig->render('Story/cooperate.html.twig', ['stories' => $stories]);
    }

    public function read()
    {
        $stories = $this->storyManager->selectAll();
        return $this->twig->render('Story/read.html.twig', ['stories' => $stories]);
    }

    /**
     * Show chapters for a specific story
     */
    public function show(int $storyId): string
    {
        $story = $this->storyManager->selectOneById($storyId);
        $chapters = $this->chapterManager->selectAllByStory($storyId, 'created_at');

        return $this->twig->render('Story/show.html.twig', ['story' => $story, 'chapters' => $chapters]);
    }

    /**
     * function sécurisant les données d'une story
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
            return $errors;
        }
    }

    /**
     * Add a new story
     */
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
                $id =  $storyManager->insert($story, $this->user);

                header('Location:/chapters/add?id=' . $id);
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

            $this->storyManager->delete((int)$id);

            header('Location:/stories');
        }
    }
}
