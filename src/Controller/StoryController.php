<?php

namespace App\Controller;

use App\Model\StoryManager;
use App\Model\ChapterManager;

class StoryController extends AbstractController
{
    private ChapterManager $chapterManager;
    private StoryManager $storyManager;

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
     * Add a new story
     */
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $story = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $id =  $this->storyManager->insert($story);

            header('Location:/stories/show?id=' . $id);
            return null;
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
