<?php

namespace App\Controller;

use App\Model\ChapterManager;
use App\Model\StoryManager;

class ChapterController extends AbstractController
{
    private ChapterManager $chapterManager;
    private StoryManager $storyManager;
    public const MAX_LENGTH_TITLE = 100;
    public const MAX_LENGTH_PSEUDO = 100;

    public function __construct()
    {
        parent::__construct();
        $this->chapterManager = new ChapterManager();
        $this->storyManager = new StoryManager();
    }

    public function verify($infoNewChapter): array
    {
        $errors = [];

        if (!isset($infoNewChapter['title']) || empty($infoNewChapter['title'])) {
            $errors[] = "Dommage que votre chapitre n'ait pas de titre !";
        } elseif (strlen($infoNewChapter['title']) > self::MAX_LENGTH_TITLE) {
            $errors[] = "Le titre de votre chapitre est trop long";
        }

        if (!isset($infoNewChapter['pseudo']) || empty($infoNewChapter['pseudo'])) {
            $errors[] = "Dommage que votre chapitre n'ait pas d'auteur !";
        } elseif (strlen($infoNewChapter['pseudo']) > self::MAX_LENGTH_PSEUDO) {
            $errors[] = "Le nom de plume est trop long";
        }

        if (!isset($infoNewChapter['content']) || empty($infoNewChapter['content'])) {
            $errors[] = "Dommage que votre chapitre n'ait pas de contenu !";
        }

        return $errors;
    }

    public function add(int $storyId): ?string
    {
        $story = $this->storyManager->selectOneById($storyId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $infoNewChapter = array_map('trim', $_POST);
            $errors = $this->verify($infoNewChapter);

            if (empty($errors)) {
                $this->chapterManager->insert($infoNewChapter, $storyId);
                // $this->chapterManager->updateNumChapter($storyId);   ///num chpater ir sumando
            }

            header('Location:/stories/');
            return null;
        }
        return $this->twig->render('Chapter/add.html.twig', ['story' => $story]);
    }
}
