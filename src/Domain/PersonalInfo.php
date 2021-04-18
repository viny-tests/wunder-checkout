<?php
declare(strict_types=1);

namespace App\Domain;

class PersonalInfo
{
    public function __construct(
        private string $firstName,
        private string $lastName,
        private string $telephone
    )
    {
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }
}
