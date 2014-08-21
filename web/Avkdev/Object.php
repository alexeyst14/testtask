<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.08.14
 * Time: 17:22
 */

namespace Avkdev;

abstract class Object
{
    /**
     * @param $name
     * @return mixed
     * @throws \LogicException
     */
    final public function __get($name)
    {
        if (!isset($this->$name)) {
            throw new \LogicException("Wrong property $name");
        }
        return $this->$name;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     * @throws \LogicException
     */
    final public function __set($name, $value)
    {
        if (!isset($this->$name)) {
            throw new \LogicException("Wrong property $name");
        }
        $this->$name = $value;
        return $this;
    }

} 