<?php
declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $street;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private string $houseNumber;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private string $zipCode;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $city;

    /**
     * @ORM\OneToOne(targetEntity="Customer", inversedBy="address")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private Customer $customer;

    /**
     * @param string $street
     * @param string $houseNumber
     * @param string $zipCode
     * @param string $city
     */
    public function __construct(string $street, string $houseNumber, string $zipCode, string $city)
    {
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->zipCode = $zipCode;
        $this->city = $city;
    }
}
