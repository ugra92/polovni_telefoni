<?php
namespace App\Deserializer;
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

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function deserialize($jsonData, $class){
        $metaData = $this->entityManager->getClassMetadata($class);
//        var_dump($metaData);exit;
        $instance = new $class();
        $data = json_decode($jsonData);
        foreach ($data as $key => $value) {
            $instance->{'set'.ucfirst($key)}($value);
        }
        var_dump($instance);exit;
        return $instance;
    }
}