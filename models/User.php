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
    private string $avatar;

    public function setNickname(string $nickname): User
    {
        $this->nickname = $nickname;
        return $this;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
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

    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }
}