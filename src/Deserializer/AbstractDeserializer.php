<?php
namespace App\Deserializer;
use App\Manager\BaseManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Created by PhpStorm.
 * User: Ugra
 * Date: 1/21/2018
 * Time: 0:06
 */
class AbstractDeserializer
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var BaseManager
     */
    private $baseManager;

    /**
     * @param EntityManager $entityManager
     * @var $baseManager BaseManager
     */
    public function __construct(EntityManager $entityManager, BaseManager $baseManager)
    {
        $this->baseManager = $baseManager;
        $this->entityManager = $entityManager;
    }

    public function deserialize($jsonData, $class){
        $instance = new $class();
        $data = json_decode($jsonData);
        foreach ($data as $key => $value) {
            if(is_object($value)){
                $value = $this->entityManager->getReference('App\Entity\\'.ucfirst($key), $value->id);
            }
            $instance->{'set'.ucfirst($key)}($value);
        }

        return $instance;
    }
}