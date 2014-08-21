<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.08.14
 * Time: 17:58
 */

namespace Avkdev;

use Avkdev\Object;
use Avkdev\Passenger;

class Boat extends Object
{
    /**
     * Max weight allowed for boat
     */
    const MAX_WEIGHT = 1;

    /**
     * @var array Passenger
     */
    protected $passengers = array();

    /**
     * @param $passengers array of Passenger
     * @return $this
     * @throws \LogicException
     */
    public function addPassengers($passengers)
    {
        $passengers = is_array($passengers) ? $passengers : array($passengers);
        foreach ($passengers as $passenger) {
            if (!$this->hasPlaceFor($passenger)) {
                throw new \LogicException('No any places on the boat');
            }
            $this->passengers[$passenger->id] = $passenger;
        }
        return $this;
    }

    /**
     * @param Passenger $passenger
     * @return $this
     */
    public function removePassenger(Passenger $passenger)
    {
        unset($this->passengers[$passenger->id]);
        return $this;
    }

    /**
     * Remove all passengers from boat
     * @return $this
     */
    public function removeAll()
    {
        $this->passengers = array();
        return $this;
    }

    /**
     * Checking free place on the boat
     * @param Passenger $passenger
     * @return bool
     */
    public function hasPlaceFor(Passenger $passenger)
    {
        return $this->getCurrentWeight() + $passenger->weight <= self::MAX_WEIGHT;
    }

    /**
     * Returns current loaded weight
     * @return int
     */
    public function getCurrentWeight()
    {
        $currWeight = 0;
        foreach ($this->passengers as $pass) {
            $currWeight += $pass->weight;
        }
        return $currWeight;
    }

    /**
     * @return float
     */
    public function getMaxWeight()
    {
        return self::MAX_WEIGHT;
    }

    /**
     * @param $passengers array of Passenger
     */
    public function doTransfer($passengers)
    {
        $passengers = is_array($passengers) ? $passengers : array($passengers);
        $this->addPassengers($passengers);
        $this->removeAll();
    }


} 