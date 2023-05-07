<?php

namespace App\Model;

use PDO;

class ChapterManager extends AbstractManager
{
    public const TABLE = 'chapter';

    public function insert(array $chapter, int $storyId)
    {
        $query = "INSERT INTO " . self::TABLE . " 
        (title, pseudo, content, story_id) VALUES (:title, :pseudo, :content, :story_id);";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $chapter['title'], PDO::PARAM_STR);
        // $statement->bindValue(':number', ($recapChapters[$storyId]['numChaptersInStory']) + 1, PDO::PARAM_INT);
        $statement->bindValue(':pseudo', $chapter['pseudo'], PDO::PARAM_STR);
        $statement->bindValue(':content', $chapter['content'], PDO::PARAM_STR);
        $statement->bindValue(':story_id', $storyId, PDO::PARAM_STR);

        $statement->execute();
    }
}
