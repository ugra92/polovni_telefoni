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
//    private $em;

    public function __construct()
    {
//        $this->em = $em;
    }

    public function deserialize($jsonData, $class){
//        $metaData = $this->em->getClassMetadata($class);
        $instance = new $class();
        $data = json_decode($jsonData);
        foreach ($data as $key => $value) {
            $instance->{'set'.ucfirst($key)}($value);
        }

        return $instance;
    }
}