<?php
declare(strict_types=1);

namespace App\Infra\Repository;

use App\Domain\Customer;
use App\Domain\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class DoctrineCustomerRepository implements CustomerRepository
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function save(Customer $customer): void
    {
        $this->em->beginTransaction();

        try {
            $this->em->persist($customer);
            $this->em->flush();
            $this->em->commit();
        } catch (Exception $e) {
            $this->em->rollback();
        }
    }

    public function retrieve(string $id): Customer
    {
        $query = $this->em->createQueryBuilder();
        $query
            ->select('c')
            ->from(Customer::class, 'c')
            ->where('c.id = :id')
            ->setParameter('id', $id);

        return $query->getQuery()->getSingleResult();
    }
}
