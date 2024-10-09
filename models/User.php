<?php

class User extends AbstractEntity
{
    protected int $id;
    private string $nickname;
    private string $email;

    // version cryptéee du mot de passe. Le mot de passe en clair n'est jamais stocké
    private string $password;
    private DateTime $registrationDate;
    private ?string $avatar = null;

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
    public function setPassword(HashedPassword $hashedPassword): void
    {
        $this->password = $hashedPassword->getHash();
    }

    /**
     * Renvoie la valeur cryptée du mot de passe
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setRegistrationDate($registrationDate): void
    {
        $this->registrationDate = new DateTime($registrationDate);
    }

    public function getRegistrationDate(): DateTime
    {
        return $this->registrationDate;
    }

    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar ?? DEFAULT_AVATAR;
    }
}