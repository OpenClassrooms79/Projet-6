<?php
/**
 * @author Jocelyn Flament
 * @since 28/08/2024
 */

class User extends AbstractEntity
{
    protected int $id;
    private string $nickname;
    private string $login;
    private string $password;

    public function setNickname(string $nickname): User
    {
        $this->nickname = $nickname;
        return $this;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setLogin(string $login): User
    {
        $this->login = $login;
        return $this;
    }

    public function getLogin(): string
    {
        return $this->login;
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
}