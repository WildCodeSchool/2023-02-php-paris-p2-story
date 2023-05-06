<?php

namespace App\Model;

use PDO;

class ChapterManager extends AbstractManager
{
    public const TABLE = 'chapter';

    public function insert(array $infoNewChapter, int $id, array $recapChapters)
    {
        $query = "INSERT INTO " . self::TABLE . " 
        (title, number, pseudo, content, story_id) VALUES (:title, :number, :pseudo, :content, :story_id);";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $infoNewChapter['title'], PDO::PARAM_STR);
        $statement->bindValue(':number', ($recapChapters[$id]['numChaptersInStory']) + 1, PDO::PARAM_INT);
        $statement->bindValue(':pseudo', $infoNewChapter['pseudo'], PDO::PARAM_STR);
        $statement->bindValue(':content', $infoNewChapter['content'], PDO::PARAM_STR);
        $statement->bindValue(':story_id', $id, PDO::PARAM_STR);

        $statement->execute();
    }


    public function countChapInStory(int $id): array
    {
        $query = "SELECT COUNT(*) AS numChaptersInStory
                  FROM story LEFT JOIN chapter ON chapter.story_id=$id GROUP BY story.id;";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
