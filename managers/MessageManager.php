<?php

class MessageManager extends AbstractEntityManager
{
    public function addMessage(int $fromId, int $toId, string $content): int
    {
        $sql = "INSERT INTO messages(from_id, to_id, content) VALUES (:from_id, :to_id, :content)";
        $this->db->query($sql, [
            'from_id' => $fromId,
            'to_id' => $toId,
            'content' => $content,
        ]);

        return $this->db->getPDO()->lastInsertId();
    }

    public function getUnreadMessagesCount(User $user)
    {
        $sql = 'SELECT COUNT(*) FROM messages WHERE to_id = :user_id';
        return $this->db->query($sql, ['user_id' => $user->getId()])->fetchColumn();
    }

    /**
     * Renvoie la liste de membres qui ont envoyé au moins un message au membre $toId
     *
     * @param int $toId
     * @return void
     */
    public function getMessageSenders(int $toId): array
    {
        $sql = 'SELECT m.*, u.nickname
FROM messages m
INNER JOIN (
	SELECT DISTINCT MIN(id) OVER (PARTITION BY from_id) AS min_id
	FROM messages
	WHERE to_id = :to_id
) tmp ON m.id = tmp.min_id
INNER JOIN users u ON m.from_id = u.id';
        return $this->db->query($sql, ['to_id' => $toId])->fetchAll();
    }
}