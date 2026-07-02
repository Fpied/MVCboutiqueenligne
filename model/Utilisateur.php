<?php

class Utilisateur{
    public int $id;
    public string $name;
    public string $email;
    public $password_hash;
    public string $role;

   public function __construct(int $id, string $name, string $email,float $password_hash, string $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }
    public function getId(): int {return $this->id;}
    public function getName(): string {return $this->name;}
    public function getEmail(): string {return $this->email;}
    public function getPassword_hash(): float {return $this->password_hash;}

    public function setName(string $name): void {$this->name = $name;}
    public function setEmail(string $description): void {$this->email = $description;}
    public function setPassword_hash(float $password_hash) : void {$this->password_hash = $password_hash;}

}


?>