<?php
namespace App\Manager;
use Doctrine\ORM\EntityManager;

/**
 * Class BaseManager
 * @package App\Manager
 */
class BaseManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * BaseManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $obj
     * @return bool
     */
    public function persistObject($obj){
        try {
            $this->entityManager->persist($obj);
            $this->entityManager->flush();
        } catch (\Exception $e){
            return false;
        }

        return $obj;
    }

}