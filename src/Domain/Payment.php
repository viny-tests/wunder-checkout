<?php
declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Payment
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
    private string $paymentDataId;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $iban;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $owner;

    /**
     * @ORM\OneToOne(targetEntity="Customer", inversedBy="payment")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private Customer $customer;

    public function __construct(string $iban, string $owner)
    {
        $this->iban = $iban;
        $this->owner = $owner;
    }

    public function setPaymentId(string $paymentDataId): void
    {
        $this->paymentDataId = $paymentDataId;
    }

    public function getPaymentId(): string
    {
        return $this->paymentDataId;
    }
}
