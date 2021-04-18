<?php
declare(strict_types=1);

namespace App\Infra\Repository;

use App\Domain\Payment;
use App\Domain\PaymentGatewayRepository;
use Exception;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PaymentGatewayRepositoryThirdPart implements PaymentGatewayRepository
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private SerializerInterface $serializer
    )
    {}

    public function getList(): array
    {
        $items = [];
        try {
            $response = $this->httpClient
                ->request('GET', 'https://api.punkapi.com/v2/beers?brewed_before=11-2012&abv_gt=6');

            $items = $this->serializer->deserialize(
                $response->getContent(),
                'App\Application\Read\BeerItem[]',
                'json'
            );
        } catch (Exception $e) {
        }

        return $items;
    }

    public function processPayment(Payment $payment): void
    {
        // TODO: Implement processPayment() method.
    }
}
