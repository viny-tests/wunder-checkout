<?php
declare(strict_types=1);

namespace App\Domain;

interface CustomerRepository
{
    public function save(Customer $customer): void;
    public function retrieve(string $id): Customer;
}
