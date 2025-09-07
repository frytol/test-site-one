<?php

namespace App\Repository;

use App\Entity\Faq;
use App\Entity\FaqCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Faq>
 */
class FaqRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Faq::class);
    }

    public function findActiveOrderedByIndex(): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.isActive = :active')
            ->setParameter('active', true)
            ->orderBy('f.orderIndex', 'ASC')
            ->addOrderBy('f.question', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByCategoryOrderedByIndex(FaqCategory $category): array
    {
        return $this->createQueryBuilder('f')
            ->innerJoin('f.categories', 'c')
            ->andWhere('c.id = :categoryId')
            ->andWhere('f.isActive = :active')
            ->setParameter('categoryId', $category->getId())
            ->setParameter('active', true)
            ->orderBy('f.orderIndex', 'ASC')
            ->addOrderBy('f.question', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findBySlug(string $slug): ?Faq
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.slug = :slug')
            ->andWhere('f.isActive = :active')
            ->setParameter('slug', $slug)
            ->setParameter('active', true)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findMostViewed(int $limit = 5): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.isActive = :active')
            ->setParameter('active', true)
            ->orderBy('f.viewCount', 'DESC')
            ->addOrderBy('f.question', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Faq[]
     */
    public function findFeaturedOrderedByIndex(): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.isActive = :active')
            ->andWhere('f.isFeatured = :featured')
            ->setParameter('active', true)
            ->setParameter('featured', true)
            ->orderBy('f.orderIndex', 'ASC')
            ->addOrderBy('f.question', 'ASC')
            ->getQuery()
            ->getResult();
    }
}