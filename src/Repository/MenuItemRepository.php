<?php

namespace App\Repository;

use App\Entity\MenuItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MenuItem>
 */
class MenuItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MenuItem::class);
    }

    /**
     * @return MenuItem[]
     */
    public function findActiveOrderedByIndex(): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.isActive = :active')
            ->setParameter('active', true)
            ->orderBy('m.orderIndex', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return MenuItem[]
     */
    public function findAllOrderedByIndex(): array
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.orderIndex', 'ASC')
            ->getQuery()
            ->getResult();
    }
}