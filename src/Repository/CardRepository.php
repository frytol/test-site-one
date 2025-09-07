<?php

namespace App\Repository;

use App\Entity\Card;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Card>
 */
class CardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Card::class);
    }

    /**
     * @return Card[]
     */
    public function findActiveOrderedByIndex(): array
    {
        return $this->createQueryBuilder('c')
            ->where('c.isActive = :active')
            ->setParameter('active', true)
            ->orderBy('c.orderIndex', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Card[]
     */
    public function findByCardBlockOrderedByIndex(int $cardBlockId): array
    {
        return $this->createQueryBuilder('c')
            ->where('c.cardBlock = :cardBlockId')
            ->andWhere('c.isActive = :active')
            ->setParameter('cardBlockId', $cardBlockId)
            ->setParameter('active', true)
            ->orderBy('c.orderIndex', 'ASC')
            ->getQuery()
            ->getResult();
    }
}