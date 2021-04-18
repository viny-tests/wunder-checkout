<?php
declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string", length=40)
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private string $telephone;

    /**
     * @ORM\OneToOne(targetEntity="Address", mappedBy="customer")
     */
    private Address $address;

    /**
     * @ORM\OneToOne(targetEntity="Payment", mappedBy="customer")
     */
    private Payment $payment;

    public function __construct(
        string $id,
        string $firstName,
        string $lastName,
        string $telephone
    )
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setAddressInfo(Address $address): void
    {
        $this->address = $address;
    }

    public function setPaymentInfo(Payment $payment): void
    {
        $this->payment = $payment;
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
