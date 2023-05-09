<?php

namespace App\Controller;

use App\Model\StoryManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {	    	        
        $storyManager = new StoryManager();
        $stories = $storyManager->selectLastThree('id');
        return $this->twig->render('Home/index.html.twig', ['stories' => $stories]);
    }
}
