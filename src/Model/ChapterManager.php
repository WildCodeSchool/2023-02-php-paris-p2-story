<?php

namespace App\Model;

use PDO;
// use App\Model\StoryManager;

class ChapterManager extends AbstractManager
{
    public const TABLE = 'chapter';
    // private StoryManager $storyManager;
    // public const TABLE2 = 'story';


    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->storyManager = new StoryManager();
    // }






    public function insert(array $infoNewChapter, int $id): int //editar para modif et liaison avec histoire
    {
        // $storyManager = new StoryManager;

        // $countChaps = $storyManager->countChapInStory();

        // var_dump($infoNewChapter);
        // echo $infoStory['nbchapter'] . ' ' . $countChaps[$id]['num'] + 1;
        // var_dump($countChaps[$id]); //combien chapitres a cette histoire(id)
        // exit();


        // if ($infoStory['nbchapter'] === $countChaps[$id]['num'] + 1){ 
        //     $infoStory['ended'] = 1;
        // }

        //    // si num chapitres histoire est egal a numchapitres+1 --> ended=1
        //     //RAJOUTER ENDED SI FIN CHAPITRES
        //     $statement = $this->pdo->prepare("UPDATE story SET ended=:ended WHERE id=:id");
        //     $statement->bindValue(':ended',  $infoStory['ended'], PDO::PARAM_INT);
        //     $statement->bindValue(':id', $id, PDO::PARAM_STR);

        //     $statement->execute();



        /// OOOOOOOOOOOOOOOOOOOOOK


        // public function insert(array $arrayInfoChapter, int $id): int 
        // {

        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (title, pseudo, content, story_id) VALUES (:title, :pseudo, :content, :story_id)");
        $statement->bindValue(':title', $infoNewChapter['title'], PDO::PARAM_STR);
        $statement->bindValue(':pseudo', $infoNewChapter['pseudo'], PDO::PARAM_STR);
        $statement->bindValue(':content', $infoNewChapter['content'], PDO::PARAM_STR);
        $statement->bindValue(':story_id', $id, PDO::PARAM_STR); //on done la même id de l'histoire aux chapitres dans stories_id

        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }
}
