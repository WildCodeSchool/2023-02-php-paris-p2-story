<?php

namespace App\Model;

use PDO;

class ChapterManager extends AbstractManager
{
    public const TABLE = 'chapter';

    public function countChapInStory(int $storyId): int
    {
        $query = "SELECT COUNT(*) AS numChaps FROM " . self::TABLE . " WHERE story_id=$storyId GROUP BY story_id;";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        $recapChaps = $statement->fetch();

        return $recapChaps['numChaps'];
    }

    public function insert(array $chapter, int $storyId)
    {
        $query = "INSERT INTO " . self::TABLE . " 
        (title, pseudo, content, story_id) VALUES (:title, :pseudo, :content, :story_id);";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $chapter['title'], PDO::PARAM_STR);
        $statement->bindValue(':pseudo', $chapter['pseudo'], PDO::PARAM_STR);
        $statement->bindValue(':content', $chapter['content'], PDO::PARAM_STR);
        $statement->bindValue(':story_id', $storyId, PDO::PARAM_INT);

        $statement->execute();
    }

    public function selectAllByStory(int $storyId, string $orderBy = ''): array|false
    {
        $query = "SELECT chapter.title, chapter.pseudo, chapter.content
                  FROM " . self::TABLE . " 
                  JOIN story ON chapter.story_id=" . $storyId . " 
                  WHERE story.id=" . $storyId;

        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy;
        }

        return $this->pdo->query($query)->fetchAll();
    }
}
