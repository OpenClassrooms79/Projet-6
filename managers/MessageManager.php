<?php

class MessageManager extends AbstractEntityManager
{
    /**
     * Ajout d'un message
     *
     * @param Message $message
     * @return int ID du message ajouté dans la table MySQL
     */
    public function add(Message $message): int
    {
        $sql = "INSERT INTO messages(from_id, to_id, content) VALUES (:from_id, :to_id, :content)";
        $res = $this->db->query($sql, [
            'from_id' => $message->getFromId(),
            'to_id' => $message->getToId(),
            'content' => $message->getContent(),
        ]);

        if (is_int($res)) {
            throw new RuntimeException($this->error(self::ERR_INSERT, $res));
        }
        return $this->db->getPDO()->lastInsertId();
    }

    public function getUnreadMessagesCount(int $userId)
    {
        $sql = 'SELECT COUNT(*) FROM messages WHERE to_id = :user_id AND is_read = 0';
        return $this->db->query($sql, ['user_id' => $userId])->fetchColumn();
    }

    /**
     * Renvoie la liste des utilisateurs qui ont envoyé au moins un message à l'utilisateur $toId ou reçu au moins un message de l'utilisateur $toId
     *
     * @param int $toId
     * @return array
     */
    public function getMessageSenders(int $toId): array
    {
        // messages envoyés par un autre utilisateur
        $sql1 = 'SELECT m.*, u.id AS user_id, u.nickname
FROM messages m
INNER JOIN (
	SELECT DISTINCT MAX(id) OVER (PARTITION BY from_id) AS min_id
	FROM messages
	WHERE to_id = :to_id
) tmp ON m.id = tmp.min_id
INNER JOIN users u ON m.from_id = u.id';

        // messages envoyés par l'utilisateur courant, mais n'ayant pas encore de réponse
        $sql2 = 'SELECT m.*, u.id AS user_id, u.nickname
FROM (
	SELECT DISTINCT from_id, to_id
	FROM messages
	WHERE from_id = :to_id
) t1
LEFT JOIN (
	SELECT DISTINCT from_id, to_id
	FROM messages
	WHERE to_id = :to_id
) t2 ON t1.from_id = t2.to_id AND t1.to_id = t2.from_id
INNER JOIN messages m ON m.from_id = t1.from_id AND m.to_id = t1.to_id
INNER JOIN users u ON t1.to_id = u.id
WHERE t2.from_id IS NULL';
        return $this->db->query("$sql1 UNION $sql2", ['to_id' => $toId])->fetchAll();
    }

    public function getDiscussion(int $userId1, int $userId2): array
    {
        $sql = 'SELECT * FROM messages WHERE from_id = :user1 AND to_id = :user2 OR from_id = :user2 AND to_id = :user1 ORDER BY id';
        $res = $this->db->query($sql, [
            'user1' => $userId1,
            'user2' => $userId2,
        ]);
        $messages = [];
        foreach ($res as $message) {
            $messages[] = new Message($message);
        }
        return $messages;
    }

    public function setRead(int $fromId, int $toId): void
    {
        $sql = 'UPDATE messages SET is_read = 1 WHERE from_id = :from_id AND to_id = :to_id';
        $this->db->query($sql, [
            'from_id' => $fromId,
            'to_id' => $toId,
        ]);
    }
}