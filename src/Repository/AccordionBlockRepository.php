<?php

namespace App\Repository;

use App\Entity\AccordionBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccordionBlock>
 */
class AccordionBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccordionBlock::class);
    }

    public function findActive(): ?AccordionBlock
    {
        return $this->createQueryBuilder('ab')
            ->where('ab.isActive = :active')
            ->setParameter('active', true)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return AccordionBlock[]
     */
    public function findAllActive(): array
    {
        return $this->createQueryBuilder('ab')
            ->where('ab.isActive = :active')
            ->setParameter('active', true)
            ->orderBy('ab.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}