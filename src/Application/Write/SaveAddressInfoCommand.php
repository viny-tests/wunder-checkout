<?php
declare(strict_types=1);

namespace App\Application\Write;

use App\Domain\Event;
use Symfony\Component\Validator\Constraints as Assert;

class SaveAddressInfoCommand implements Event
{
    /**
     * @Assert\NotBlank
     */
    public string $customerId;

    /**
     * @Assert\NotBlank
     */
    public string $street;

    /**
     * @Assert\NotBlank
     */
    public string $houseNumber;

    /**
     * @Assert\NotBlank
     */
    public string $zipCode;

    /**
     * @Assert\NotBlank
     */
    public string $city;
}
