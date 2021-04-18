<?php
declare(strict_types=1);

namespace App\Application\Write;

use App\Domain\Event;
use Symfony\Component\Validator\Constraints as Assert;

class SavePersonalInfoCommand implements Event
{
    /**
     * @Assert\NotBlank
     */
    public string $firstName;

    /**
     * @Assert\NotBlank
     */
    public string $lastName;

    /**
     * @Assert\NotBlank
     */
    public string $telephone;

    public function __construct(
        public string $uuid
    )
    {
    }
}
