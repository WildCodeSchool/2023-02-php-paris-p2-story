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
    public function edit(int $id): ?string
    {
        $storyManager = new StoryManager();
        $story = $storyManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $story = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $storyManager->update($story);

            header('Location: /stories/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Story/edit.html.twig', [
            'story' => $story,
        ]);
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
            $storyManager = new StoryManager();
            $id =  $storyManager->insert($story);



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
            $storyManager = new StoryManager();
            $storyManager->delete((int)$id);

            header('Location:/stories');
        }
    }
}
