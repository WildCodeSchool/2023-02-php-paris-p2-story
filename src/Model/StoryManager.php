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

    public function checkEndedStory(int $storyId)
    {
        $query = "UPDATE " . self::TABLE . " SET story.ended=1 WHERE story.id=$storyId;";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }

    /**
     * Show last published stories on Home
     */
    public function selectLastThree(string $orderBy = '', string $direction = 'DESC'): array
    {
        $query = 'SELECT picture, title, pseudo FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction . ' LIMIT 3';
        }

        return $this->pdo->query($query)->fetchAll();
    }
}
