<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.08.14
 * Time: 18:40
 */

namespace Avkdev\Passenger;

use Avkdev\Passenger;

class Collection
{
    /**
     * @var array of Passenger
     */
    private $items = array();

    /**
     * @param $passengers array of Passenger
     * @return $this
     */
    public function add($passengers)
    {
        $passengers = is_array($passengers) ? $passengers : array($passengers);
        foreach ($passengers as $passenger) {
            $this->items[$passenger->id] = $passenger;
        }

        uasort($this->items, function($a, $b) {
                if ($a->weight == $b->weight) {
                    return 0;
                }
                return ($a->weight < $b->weight) ? -1 : 1;
            });

        return $this;
    }

    /**
     * @param $passengers array of Passenger
     * @return $this
     */
    public function remove($passengers)
    {
        $passengers = is_array($passengers) ? $passengers : array($passengers);
        foreach ($passengers as $passenger) {
            unset($this->items[$passenger->id]);
        }
        return $this;
    }

    /**
     * @param $maxWeight float
     * @return array of Passenger
     */
    public function getMaxQtyPassengers($maxWeight)
    {
        $currWeight = 0;
        $items = array();
        foreach ($this->items as $item) {
            if ($item->weight + $currWeight > $maxWeight) {
                break;
            }
            $currWeight += $item->weight;
            $items[$item->id] = $item;
        }
        return $items;
    }

    /**
     * @param $maxWeight float
     * @return  array of Passenger
     */
    public function getMaxWeightPassengers($maxWeight)
    {
        $weights = array();
        $ids = array();
        foreach ($this->items as $item) {
            $weights[] = $item->weight;
            $ids[] = $item->id;
        }

        $cnt = count($weights);
        $keys = array();
        $weight = 0;
        for ($i = $cnt-1; $i >= 0; $i--) {
            if ($weights[$i] == $maxWeight) {
                $keys[] = $ids[$i];
                break;
            }
            $weight += $weights[$i];
            for ($j = 0; $j <= floor($cnt/2); $j++) {
                if ($weight + $weights[$j] > $maxWeight) {
                    break 2;
                }
                $weight += $weights[$j];
                $keys[] = $ids[$j];
            }
        }
        return array_intersect_key($this->items, array_flip($keys));
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
     * @return Passenger
     */
    public function getLightPassenger()
    {
        reset($this->items);
        return current($this->items);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $items = array();
        foreach ($this->items as $item) {
            $items[] = $item->name;
        }
        return !empty($items) ? implode (', ', $items) : '-';
    }
}