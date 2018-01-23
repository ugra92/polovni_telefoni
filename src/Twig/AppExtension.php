<?php

namespace App\Twig;

use Doctrine\ORM\EntityManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    /**
     * @var EntityManager $entityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_entities', [$this, 'getEntities']),
        ];
    }

    /**
     * @param $entityClass
     * @return mixed
     */
    public function getEntities($entityClass)
    {
        $repo = $this->entityManager->getRepository($entityClass);
        $result = $repo->findAll();

        return $result;
    }

}
