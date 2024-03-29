<?php

namespace App\Model;

use PDO;

class StoryManager extends AbstractManager
{
    public const TABLE = 'story';

    /**
     * Insert new story in database - UPDATED by Vincent
     */
    public function insert(array $story, array $creator): int
    {
        $query = 'INSERT INTO '
            . self::TABLE . '(picture, title, pseudo, creator_id, nbchapter, genre, lectorat, description) 
        VALUES (:picture, :title, :pseudo, :creator_id, :nbchapter, :genre, :lectorat, :description);';

        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':picture', $story['picture'], PDO::PARAM_STR);
        $statement->bindValue(':title', $story['title'], PDO::PARAM_STR);
        $statement->bindValue(':pseudo', $story['pseudo'], PDO::PARAM_STR);
        $statement->bindValue(':creator_id', $creator['id'], PDO::PARAM_INT);
        $statement->bindValue(':nbchapter', $story['nbchapter'], PDO::PARAM_INT);
        $statement->bindValue(':genre', $story['genre'], PDO::PARAM_STR);
        $statement->bindValue(':description', $story['description'], PDO::PARAM_STR);
        $statement->bindValue(':lectorat', $story['lectorat'], PDO::PARAM_STR);

        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }
    /**
     * Update story in database - UPDATED by Vincent
     */
    public function update(array $story)
    {
        $query = "UPDATE story 
        SET `picture`= :picture, `title`= :title, `pseudo` = :pseudo, `nbchapter` = :nbchapter, 
        `genre` = :genre, `description` = :description, `lectorat` = :lectorat, 
        WHERE `id` = :id";
        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':picture', $story['picture'], PDO::PARAM_STR);
        $statement->bindValue(':title', $story['title'], PDO::PARAM_STR);
        $statement->bindValue(':pseudo', $story['pseudo'], PDO::PARAM_STR);
        $statement->bindValue(':nbchapter', $story['nbchapter'], PDO::PARAM_INT);
        $statement->bindValue(':genre', $story['genre'], PDO::PARAM_STR);
        $statement->bindValue(':description', $story['description'], PDO::PARAM_STR);
        $statement->bindValue(':lectorat', $story['lectorat'], PDO::PARAM_INT);
        $statement->bindValue(':id', $story['id'], PDO::PARAM_INT);

        $statement->execute();
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
    public function selectLastThreeEnded(string $orderBy = '', string $direction = 'DESC'): array
    {
        $query = 'SELECT id, picture, title, pseudo FROM ' . static::TABLE . ' WHERE ended=1';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction . ' LIMIT 3';
        }

        return $this->pdo->query($query)->fetchAll();
    }
}
