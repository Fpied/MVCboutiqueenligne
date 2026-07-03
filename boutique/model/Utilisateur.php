<?php

class Utilisateur
{
    public int $id;
    public string $name;
    public string $email;
    public string $password_hash;
    public string $role;

    public function __construct(int $id, string $name, string $email, string $password_hash, string $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->role = $role;
    }

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getPassword_hash(): string { return $this->password_hash; }
    public function getRole(): string { return $this->role; }

    public function setId(int $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPassword_hash(string $password_hash): void { $this->password_hash = $password_hash; }
    public function setRole(string $role): void { $this->role = $role; }
}