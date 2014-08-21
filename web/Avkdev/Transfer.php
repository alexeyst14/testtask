<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.08.14
 * Time: 18:51
 */

namespace Avkdev;

use Avkdev\Boat;
use Avkdev\Passenger\Collection;

class Transfer
{
    /**
     * @var Collection
     */
    private $beachA;

    /**
     * @var Collection
     */
    private $beachB;

    /**
     * @var Boat
     */
    private $boat;

    /**
     * @param Boat $boat
     * @param Collection $a
     * @param Collection $b
     */
    public function __construct(Boat $boat, Collection $a, Collection $b)
    {
        $this->boat = $boat;
        $this->beachA = $a;
        $this->beachB = $b;
    }

    /**
     * Transfer algorythm
     * @throws \RuntimeException
     */
    public function process()
    {
        // if we can't transfer in first iteration then mission impossible
        $passengers = $this->beachA->getMaxQtyPassengers($this->boat->getMaxWeight());
        if (count($passengers) < 2) {
            throw new \RuntimeException("Mission impossible");
        }

        while (true) {
            $this->logStatus();

            // Goto beach B
            // We must transfer many light peoples or one havy human
            $passengers = $this->beachA->getMaxQtyPassengers($this->boat->getMaxWeight());
            if (count($passengers) < 2) {
                $passengers = $this->beachA->getMaxWeightPassengers($this->boat->getMaxWeight());
            }
            $this->moveToB($passengers);

            // if no anybody on beach A
            if ($this->beachA->isEmpty()) {
                break;
            }

            // Return to beach A
            // We must return one light passenger
            $passenger = $this->beachB->getLightPassenger();
            $this->moveToA($passenger);
        }
        $this->logStatus();
    }

    /**
     * Move passengers to location B
     * @param $passengers
     */
    private function moveToB($passengers)
    {
        Logger::getInstance()->add("Плывем на берег Б. В лодке: " . Passenger::passengersString($passengers));
        $this->beachA->remove($passengers);
        $this->boat->doTransfer($passengers);
        $this->beachB->add($passengers);
    }

    /**
     * Move passengers to location A
     * @param $passengers
     */
    private function moveToA($passengers)
    {
        Logger::getInstance()->add("Возвращаемся на берег А. В лодке: " . Passenger::passengersString($passengers));
        $this->beachB->remove($passengers);
        $this->boat->doTransfer($passengers);
        $this->beachA->add($passengers);
    }

    /**
     * Add status to logs
     */
    private function logStatus()
    {
        Logger::getInstance()
            ->add("---------Статус----------")
            ->add("На берегу А: " . $this->beachA)
            ->add("На берегу Б: " . $this->beachB)
            ->add("-------------------------");

    }

}