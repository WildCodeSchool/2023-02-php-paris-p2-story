<?php

namespace App\Model;

use PDO;
use App\Model\ChapterManager;

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

    public function SelectAllById(int $id): array|false
    {
        // prepared request
        // $chapter =
        $statement = $this->pdo->prepare("SELECT story.title AS story_title, story.genre AS story_genre, story.pseudo AS story_pseudo, story.picture AS story_picture, story.nbchapter AS story_nbchapter, story.lectorat AS story_lectorat, story.description AS story_description, chapter.title AS chapter_title, chapter.pseudo AS chapter_pseudo, chapter.number AS chapter_number, chapter.title AS chapter_title, chapter.content AS chapter_content FROM " . static::TABLE . " JOIN chapter ON chapter.story_id=story.id");
        // $statement->bindValue('s.id', $id, \PDO::PARAM_INT);
        // $statement->bindValue('c.story_id', $chapter['id'], \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
