<?php

namespace App\Repository;

use App\Entity\Attribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class AttributeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Attribute::class);
    }

    /**
     * @return mixed
     */
    public function findAllForEdit()
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->getQuery()
            ->getResult()
        ;
    }

}
