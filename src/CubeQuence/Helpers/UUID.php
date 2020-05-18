<?php

namespace CQ\Helpers;

use Ramsey\Uuid\Uuid as UuidBase;
use Ramsey\Uuid\Type\Hexadecimal;
use Ramsey\Uuid\Provider\Node\StaticNodeProvider;

class UUID
{
    private static $namespace = '4addcce9-7218-4fd4-97c8-28fd71b227dd';
    private static $hex_namespace = '63756265';

    /**
     * Return V4 Random UUID
     * 
     * @return string
     */
    public static function v4()
    {
        return UuidBase::uuid4()->toString();
    }

    /**
     * Return V5 Name-Based UUID
     * 
     * @param string $name
     * 
     * @return string
     */
    public static function v5($name)
    {
        return UuidBase::uuid5(self::$namespace, $name)->toString();
    }

    /**
     * Return V6 Ordered-Time UUID
     * 
     * @return string
     */
    public static function v6()
    {
        $node = new Hexadecimal(self::$hex_namespace);
        $nodeProvider = new StaticNodeProvider($node);

        return UuidBase::uuid6($nodeProvider->getNode())->toString();
    }
}
