<?php

class UserManager extends AbstractEntityManager
{
    public function addUser(User $user): int
    {
        $sql = "INSERT INTO users(nickname, email, password, avatar) VALUES (:nickname, :email, :password, :avatar)";
        $res = $this->db->query($sql, [
            'nickname' => $user->getNickname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'avatar' => $user->getAvatar(),
        ]);

        if (is_int($res)) {
            if ($res === ER_DUP_ENTRY) {
                throw new Exception("L'adresse e-mail ou le pseudo sont déjà utilisés", $res);
            }

            throw new Exception('Impossible de mettre à jour les données', $res);
        }
        return $this->db->getPDO()->lastInsertId();
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
                    $user->setPassword(new HashedPassword($password));
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
        $this->db->query($sql, [$user->getPassword(), $user->getId()]);
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
        while ($r = $res->fetch()) {
            $books[] = new Book($r);
        }
        return $books;
    }

    /**
     * @throws Exception
     */
    public function save(User $user): bool
    {
        $sql = 'UPDATE users SET nickname = :nickname, email = :email, password = :password WHERE id = :id';
        $res = $this->db->query($sql, [
            'id' => $user->getId(),
            'nickname' => $user->getNickname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]);
        if (is_int($res)) {
            if ($res === ER_DUP_ENTRY) {
                throw new Exception("L'adresse e-mail ou le pseudo sont déjà utilisés", $res);
            }

            throw new Exception('Impossible de mettre à jour les données', $res);
        }
        return true;
    }
}