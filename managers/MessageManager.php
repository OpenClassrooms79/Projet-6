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

    /**
     * Récupération d'un message
     *
     * @param int $id
     * @return Message
     */
    public function getById(int $id): Message
    {
        $sql = "SELECT * FROM messages WHERE id = :id";
        $res = $this->db->query($sql, ['id' => $id]);
        if ($res->rowCount() === 1) {
            return new Message($res->fetch(PDO::FETCH_ASSOC));
        }
        throw new RuntimeException(Message::ERR_NOT_FOUND . " (id = $id)");
    }

    /**
     * Mise à jour d'un message
     *
     * @param Message $message
     * @return void
     */
    public function update(Message $message): void
    {
        $sql = "UPDATE messages 
SET from_id = :from_id, messages.to_id = :to_id, content = :content, created = :created, is_read = :is_read
WHERE id = :id";
        $res = $this->db->query($sql, [
            'from_id' => $message->getFromId(),
            'to_id' => $message->getToId(),
            'content' => $message->getContent(),
            'created' => $message->getCreated(),
            'is_read' => (int) $message->isRead(),
            'id' => $message->getId(),
        ]);
        if (is_int($res)) {
            throw new RuntimeException($this->error(self::ERR_UPDATE, $res));
        }
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
    SELECT t1.from_id, t1.to_id, MAX(t1.id) AS max_id
    FROM messages t1
    LEFT JOIN messages t2 ON t1.from_id = t2.to_id AND t1.to_id = t2.from_id
    WHERE t1.from_id = :to_id AND t2.from_id IS NULL
    GROUP BY t1.from_id, t1.to_id
) tmp
INNER JOIN messages m ON tmp.max_id = m.id
INNER JOIN users u ON tmp.to_id = u.id';
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