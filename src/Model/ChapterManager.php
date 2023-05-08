<?php

namespace App\Model;

use PDO;

class ChapterManager extends AbstractManager
{
    public const TABLE = 'chapter';

    public function insert(array $infoNewChapter, int $storyId): int
    {
        $query = "INSERT INTO " . self::TABLE . " 
        (title, pseudo, content, story_id) VALUES (:title, :pseudo, :content, :story_id);";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $infoNewChapter['title'], PDO::PARAM_STR);
        $statement->bindValue(':pseudo', $infoNewChapter['pseudo'], PDO::PARAM_STR);
        $statement->bindValue(':content', $infoNewChapter['content'], PDO::PARAM_STR);
        $statement->bindValue(':story_id', $storyId, PDO::PARAM_STR);

        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }

    public function getNumChapInStory(int $storyId): int
    {
        $query = "SELECT COUNT(*) AS numChaps FROM " . self::TABLE . " WHERE story_id=$storyId GROUP BY story_id;";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        $recapChaps = $statement->fetch();

        return $recapChaps['numChaps'];
    }
}
