<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.08.14
 * Time: 17:22
 */

namespace Avkdev;

use Avkdev\Object;

/**
 * Class Passenger
 * @package Avkdev
 *
 * @property $weight
 * @property $name
 * @property $id
 */
abstract class Passenger extends Object
{
    /**
     * @var float
     */
    protected $weight = 0;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $id = '';

    /**
     * @param $name string
     */
    public function __construct($name)
    {
        $this->id = md5($name);
        $this->name = $name;
    }

    /**
     * @param $passengers array of Passenger
     * @return string
     */
    public static function passengersString($passengers)
    {
        $passengers = is_array($passengers) ? $passengers : array($passengers);
        $str = array();
        foreach ($passengers as $passenger) {
            $str[] = $passenger->name;
        }
        return implode(", ", $str);
    }
} 