<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'customers')]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $firstName;

    #[ORM\Column(length: 100)]
    private string $lastName;

    #[ORM\Column(length: 100, unique: true)]
    private string $email;

    #[ORM\Column(length: 100)]
    private string $username;

    #[ORM\Column(length: 20)]
    private string $gender;

    #[ORM\Column(length: 100)]
    private string $country;

    #[ORM\Column(length: 100)]
    private string $city;

    #[ORM\Column(length: 50)]
    private string $phone;

    #[ORM\Column(length: 255)]
    private string $password;

    // Add your getters and setters or use a trait (optional)
    public function getId(): int
    {
        return $this->id;
    }
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function setFirstName(string $val): void
    {
        $this->firstName = $val;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
    public function setLastName(string $val): void
    {
        $this->lastName = $val;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $val): void
    {
        $this->email = $val;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $val): void
    {
        $this->username = $val;
    }

    public function getGender(): string
    {
        return $this->gender;
    }
    public function setGender(string $val): void
    {
        $this->gender = $val;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
    public function setCountry(string $val): void
    {
        $this->country = $val;
    }

    public function getCity(): string
    {
        return $this->city;
    }
    public function setCity(string $val): void
    {
        $this->city = $val;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
    public function setPhone(string $val): void
    {
        $this->phone = $val;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $val): void
    {
        $this->password = $val;
    }
}
