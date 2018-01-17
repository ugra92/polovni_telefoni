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
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="productAttributeValues")
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
}
