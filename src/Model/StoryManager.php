<?php

namespace App\Model;

use PDO;

class StoryManager extends AbstractManager
{
    public const TABLE = 'story';

    /**
     * Insert new story in database - TO BE UPDATED by Vincent
     */
    public function insert(array $story): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $story['title'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update story in database - TO BE UPDATED by Vincent
     */
    public function update(array $story): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $story['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $story['title'], PDO::PARAM_STR);

        return $statement->execute();
    }

    public function countChapInStory(int $id): array
    {
        $query = "SELECT story.title, chapter.story_id, COUNT(*) AS numChapters
                  FROM story LEFT JOIN chapter ON chapter.story_id=$id GROUP BY story.id;";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function endedStory(int $id)
    {
        $query = "UPDATE story SET story.ended=1 WHERE story.id=$id;";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }
}
