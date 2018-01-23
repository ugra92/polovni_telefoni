<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\AttributeValue;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributeRepository")
 */
class Attribute
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $compareAlgorithm;

    /**
     * @ORM\Column(type="boolean")
     */
    private $featured;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AttributeSet", inversedBy="attributes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $attributeSet;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AttributeValue", mappedBy="attribute")
     */
    private $values;

    public function __construct()
    {
        $this->values = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getCompareAlgorithm()
    {
        return $this->compareAlgorithm;
    }

    /**
     * @param mixed $compareAlgorithm
     */
    public function setCompareAlgorithm($compareAlgorithm)
    {
        $this->compareAlgorithm = $compareAlgorithm;
    }

    /**
     * @return mixed
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * @param mixed $featured
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }

    /**
     * @return mixed
     */
    public function getAttributeSet()
    {
        return $this->attributeSet;
    }

    /**
     * @param mixed $attributeSet
     */
    public function setAttributeSet($attributeSet)
    {
        $this->attributeSet = $attributeSet;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param mixed $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }

    /**
     * @param \App\Entity\AttributeValue $value
     */
    public function addValue(AttributeValue $value)
    {
        $this->values[] = $value;
        $value->setAttribute($this);
    }

    /**
     * @param \App\Entity\AttributeValue $value
     */
    public function removeValue(AttributeValue $value)
    {
        $this->values->removeElement($value);
        $value->setAttribute(null);
    }

    /**
     * @return mixed
     */
    public function toString(){
        return $this->getName();
    }
}
