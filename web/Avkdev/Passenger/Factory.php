<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.08.14
 * Time: 18:54
 */

namespace Avkdev\Passenger;

use Avkdev\Passenger;

class Factory
{
    /**
     * @param $type
     * @param $name
     * @return Passenger
     * @throws \LogicException
     */
    public static function create($type, $name)
    {
        $class = "Avkdev\\Passenger\\" . $type;
        if (!class_exists ($class)) {
            throw new \LogicException("Can't create passenger $class");
        }
        return new $class($name);
    }
} 