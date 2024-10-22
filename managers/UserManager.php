<?php

class UserManager extends AbstractEntityManager
{
    /**
     * Ajout d'un utilisateur
     *
     * @param User $user
     * @return int ID de l'utilisateur ajouté dans la table MySQL
     */
    public function add(User $user): int
    {
        $sql = "INSERT INTO users(nickname, email, hashed_password) VALUES (:nickname, :email, :hashed_password)";
        $res = $this->db->query($sql, [
            'nickname' => $user->getNickname(),
            'email' => $user->getEmail(),
            'hashed_password' => $user->getHashedPassword(),
        ]);

        if (is_int($res)) {
            if ($res === ER_DUP_ENTRY) {
                throw new RuntimeException($this->error("Erreur : l'adresse e-mail ou le pseudo sont déjà utilisés", $res));
            }

            throw new RuntimeException($this->error(self::ERR_INSERT, $res));
        }
        return $this->db->getPDO()->lastInsertId();
    }

    /**
     * Récupération d'un utilisateur
     *
     * @param int $id
     * @return User
     */
    public function getById(int $id): User
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $res = $this->db->query($sql, ['id' => $id]);
        if ($res->rowCount() === 1) {
            return new User($res->fetch(PDO::FETCH_ASSOC));
        }
        throw new RuntimeException(User::ERR_NOT_FOUND . " (id = $id)");
    }

    /**
     * Mise à jour d'un utilisateur
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
    {
        $sql = 'UPDATE users SET nickname = :nickname, email = :email, hashed_password = :hashed_password WHERE id = :id';
        $res = $this->db->query($sql, [
            'id' => $user->getId(),
            'nickname' => $user->getNickname(),
            'email' => $user->getEmail(),
            'hashed_password' => $user->getHashedPassword(),
        ]);
        if (is_int($res)) {
            if ($res === ER_DUP_ENTRY) {
                throw new RuntimeException("L'adresse e-mail ou le pseudo sont déjà utilisés", $res);
            }

            throw new RuntimeException('Impossible de mettre à jour les données', $res);
        }
        return true;
    }

    /**
     * Suppression d'un utilisateur
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        $sql = 'DELETE FROM users WHERE id = :id';
        $res = $this->db->query($sql, ['id' => $user->getId()]);
        if (is_int($res)) {
            throw new RuntimeException("Impossible de supprimer l'utilisateur", $res);
        }
        return true;
    }

    public function login(string $email, string $password): ?User
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $res = $this->db->query($sql, [
            'email' => $email,
        ]);
        if ($res->rowCount() === 1) {
            $r = $res->fetch();
            $user = new User($r);
            if (password_verify($password, $user->getHashedPassword())) {
                if (password_needs_rehash($user->getHashedPassword(), PASSWORD_DEFAULT)) {
                    // On crée un nouveau hachage afin de mettre à jour l'ancien
                    $user->setPassword($password);
                    $this->updatePassword($user);
                }
                return $user;
            }
            return null;
        }
        return null;
    }

    public function updatePassword(User $user): void
    {
        $sql = "UPDATE users SET hashed_password = :hashed_password WHERE id = :id";
        $this->db->query($sql, [
            'hashed_password' => $user->getHashedPassword(),
            'id' => $user->getId(),
        ]);
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
}