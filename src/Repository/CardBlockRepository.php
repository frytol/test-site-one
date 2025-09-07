<?php

namespace App\Repository;

use App\Entity\CardBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CardBlock>
 */
class CardBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardBlock::class);
    }

    public function findActive(): ?CardBlock
    {
        return $this->createQueryBuilder('cb')
            ->where('cb.isActive = :active')
            ->setParameter('active', true)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return CardBlock[]
     */
    public function findAllActive(): array
    {
        return $this->createQueryBuilder('cb')
            ->leftJoin('cb.cards', 'c')
            ->addSelect('c')
            ->where('cb.isActive = :active')
            ->setParameter('active', true)
            ->orderBy('cb.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}