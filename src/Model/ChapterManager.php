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

    public function selectAllByStory(int $storyId): array|false
    {
        $query = "SELECT chapter.title, chapter.pseudo, chapter.number, chapter.content 
        FROM " . self::TABLE .
            " JOIN story ON chapter.story_id=" . $storyId .
            " WHERE story.id=" . $storyId;

        return $this->pdo->query($query)->fetchAll();
    }
}
