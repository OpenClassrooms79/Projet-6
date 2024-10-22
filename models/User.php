<?php

class User extends AbstractEntity
{
    public const ERR_NOT_FOUND = 'utilisateur inexistant';

    protected int $id;
    private string $nickname;
    private string $email;

    // version cryptéee du mot de passe. Le mot de passe en clair n'est jamais stocké
    private string $hashedPassword;
    private DateTime $registrationDate;

    /**
     * @throws Exception
     */
    public function setNickname(string $nickname): void
    {
        $nickname = trim($nickname);
        if ($nickname !== '') {
            $this->nickname = $nickname;
        } else {
            throw new LengthException('Le pseudo ne peut pas être vide');
        }
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @throws Exception
     */
    public function setEmail(string $email): void
    {
        $email = trim($email);
        if (filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_FLAG_EMAIL_UNICODE)) {
            $this->email = $email;
        } else {
            throw new UnexpectedValueException("Email invalide");
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Affecte une nouvelle valeur de mot de passe crypté
     *
     * @throws Exception
     */
    public function setHashedPassword(string $hashedPassword): void
    {
        $this->hashedPassword = $hashedPassword;
    }

    /**
     * Renvoie la valeur cryptée du mot de passe
     */
    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }

    /**
     * Initialise le mot de passe crypté à partir du mot de passe en clair
     * Le mot de passe en clair n'est jamais stocké
     *
     * @param string $password
     * @return void
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        if ($password !== '') {
            $this->setHashedPassword(Utils::getHashedValue($password));
        } else {
            throw new LengthException('Le mot de passe ne peut pas être vide');
        }
    }

    /**
     * @throws DateMalformedStringException
     */
    public function setRegistrationDate(string $registrationDate): void
    {
        $this->registrationDate = new DateTime($registrationDate);
    }

    public function getRegistrationDate(): DateTime
    {
        return $this->registrationDate;
    }

    public function getAvatarPath(): string
    {
        if (file_exists($this->getCustomAvatarPath())) {
            return $this->getCustomAvatarPath();
        }
        return $this->getDefaultAvatarPath();
    }

    public function getDefaultAvatarPath(): string
    {
        return AVATARS_PATH . DEFAULT_AVATAR;
    }

    public function getCustomAvatarPath(): string
    {
        return AVATARS_PATH . $this->id;
    }
}