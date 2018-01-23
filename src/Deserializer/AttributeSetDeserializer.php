<?php
namespace App\Deserializer;
use App\Deserializer\AbstractDeserializer;

/**
 * Created by PhpStorm.
 * User: Ugra
 * Date: 1/21/2018
 * Time: 0:03
 */
class AttributeSetDeserializer extends AbstractDeserializer
{

    /**
     * @param $content
     */
    public static function deserializeData($content)
    {
        return self::deserialize($content, \App\Entity\AttributeSet::class);

    }
}
