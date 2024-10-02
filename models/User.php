<?php
/**
 * @author Jocelyn Flament
 * @since 28/08/2024
 */

class User extends AbstractEntity
{
    protected int $id;
    private string $nickname;
    private string $email;
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
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        if ($password !== '') {
            $this->password = $password;
        } else {
            throw new LengthException('Le mot de passe ne peut pas être vide');
        }
    }

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