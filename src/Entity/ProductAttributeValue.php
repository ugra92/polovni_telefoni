<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductAttributeValueRepository")
 */
class ProductAttributeValue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="productAttributeValues", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AttributeValue", inversedBy="productAttributeValues")
     * @ORM\JoinColumn(nullable=true)
     */
    private $attributeValue;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Attribute")
     * @ORM\JoinColumn(nullable=true)
     */
    private $attribute;

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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product): void
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getAttributeValue()
    {
        return $this->attributeValue;
    }

    /**
     * @param mixed $attributeValue
     */
    public function setAttributeValue($attributeValue): void
    {
        $this->attributeValue = $attributeValue;
    }

    /**
     * @return mixed
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param mixed $attribute
     */
    public function setAttribute($attribute): void
    {
        $this->attribute = $attribute;
    }
}
