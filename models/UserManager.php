<?php

class UserManager extends AbstractEntityManager
{
    public function addUser(User $user): bool
    {
        $sql = "INSERT INTO users(nickname, email, password) VALUES (:nickname, :email, :password)";
        $res = $this->db->query($sql, [
            'nickname' => $user->getNickname(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
        ]);
        if (is_int($res)) {
            return false;
        }
        return true;
    }

    public function login(string $email, string $password): User|false
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $res = $this->db->query($sql, [
            'email' => $email,
        ]);
        if ($res->rowCount() === 1) {
            $r = $res->fetch();
            $user = new User($r);
            if (password_verify($password, $user->getPassword())) {
                if (password_needs_rehash($user->getPassword(), PASSWORD_DEFAULT)) {
                    // On crée un nouveau hachage afin de mettre à jour l'ancien
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    $user->setPassword($newHash);
                    $this->updatePassword($user);
                }
                return $user;
            }
            return false;
        }

        return false;
    }

    public function updatePassword(User $user): void
    {
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $this->db->query($sql);
    }

    public function getById(int $id): User|false
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $res = $this->db->query($sql, ['id' => $id]);
        if ($res->rowCount() === 1) {
            $r = $res->fetch();
            return new User($r);
        }
        return false;
    }

    public function getNbBooks(int $ownerId): int
    {
        $sql = "SELECT COUNT(*) AS nb FROM books WHERE owner_id = :ownerId";
        $res = $this->db->query($sql, ['ownerId' => $ownerId]);
        if ($res->rowCount() === 1) {
            return $res->fetch()['nb'];
        }
        return 0;
    }

    public function getBooks(int $ownerId): array
    {
        $sql = "SELECT * FROM books WHERE owner_id = :ownerId";
        $res = $this->db->query($sql, ['ownerId' => $ownerId]);
        $books = [];
        while ($book = $res->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }
}