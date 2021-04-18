<?php
declare(strict_types=1);

namespace App\Domain;

interface PaymentGatewayRepository
{
    public function processPayment(Payment $payment): void;
}
