<?php

namespace App\Model;

use PDO;

class StoryManager extends AbstractManager
{
    public const TABLE = 'story';

    /**
     * Insert new story in database - UPDATED by Vincent
     */
    public function insert(array $story): int
    {
        $query = 'INSERT INTO 
        story (picture, title, pseudo, nbchapter, genre, lectorat, description) 
        VALUES (:picture, :title, :pseudo, :nbchapter, :genre, :lectorat, :description);';

        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':picture', $story['picture'], PDO::PARAM_STR);
        $statement->bindValue(':title', $story['title'], PDO::PARAM_STR);
        $statement->bindValue(':pseudo', $story['pseudo'], PDO::PARAM_STR);
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
    public function update(array $story): bool
    {
        $query = "UPDATE story 
        SET `title`= :title, `pseudo` = :pseudo, `nbchapter` = :nbchapter, 
        `genre` = :genre, `description` = :description, `lectorat` = :lectorat, 
        WHERE `id` = :id";
        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':title', $story['title'], PDO::PARAM_STR);
        $statement->bindValue(':pseudo', $story['pseudo'], PDO::PARAM_STR);
        $statement->bindValue(':nbchapter', $story['nbchapter'], PDO::PARAM_INT);
        $statement->bindValue(':genre', $story['genre'], PDO::PARAM_STR);
        $statement->bindValue(':description', $story['description'], PDO::PARAM_STR);
        $statement->bindValue(':lectorat', $story['lectorat'], PDO::PARAM_INT);

        return $statement->execute();
    }
}
