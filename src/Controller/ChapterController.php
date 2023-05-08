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

    public function verify($chapter): array
    {
        $errors = [];

        if (!isset($chapter['title']) || empty($chapter['title'])) {
            $errors[] = "Dommage que votre chapitre n'ait pas de titre !";
        } elseif (strlen($chapter['title']) > self::MAX_LENGTH_TITLE) {
            $errors[] = "Le titre de votre chapitre est trop long";
        }

        if (!isset($chapter['pseudo']) || empty($chapter['pseudo'])) {
            $errors[] = "Dommage que votre chapitre n'ait pas d'auteur !";
        } elseif (strlen($chapter['pseudo']) > self::MAX_LENGTH_PSEUDO) {
            $errors[] = "Le nom de plume est trop long";
        }

        if (!isset($chapter['content']) || empty($chapter['content'])) {
            $errors[] = "Dommage que votre chapitre n'ait pas de contenu !";
        }

        return $errors;
    }

    public function add(int $storyId): ?string
    {
        $errors = [];

        $story = $this->storyManager->selectOneById($storyId);

        if (!$story['ended']) {
            $story['nb_chapters'] = count($this->chapterManager->selectAllByStory($storyId));

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $chapter = array_map('trim', $_POST);

                $errors = $this->verify($chapter);

                if (empty($errors)) {
                    $this->chapterManager->insert($chapter, $storyId);

                    if ($story['nb_chapters'] + 1 === $story['nbchapter']) {
                        $this->storyManager->checkEndedStory($storyId);
                    }

                    header('Location: /stories/show?id=' . $storyId);
                    exit();
                }
            }

            return $this->twig->render('Chapter/add.html.twig', ['story' => $story, 'errors' => $errors]);
        }
        else {
            header('Location: /stories/show?id=' . $storyId);
            exit();
        }
    }
}
