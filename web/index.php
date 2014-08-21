<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.08.14
 * Time: 17:04
 */

use \Avkdev\Passenger\Factory;
use \Avkdev\Passenger\Collection;
use \Avkdev\Boat;
use \Avkdev\Transfer;

require_once __DIR__ . '/Avkdev/Autoload.php';
\Avkdev\Autoload::register();

// Init beach A and B
$beachA = new Collection();
$beachB = new Collection();
$beachA->add(array(
    Factory::create('Adult', 'Папа Женя'),
    Factory::create('Adult', 'Мама Даша'),
    Factory::create('Adult', 'Рыбак'),
    Factory::create('Kid', 'Дочь Люся'),
    Factory::create('Kid', 'Сын Вася'),
));

// Transfer algorythm
try {
    $transfer = new Transfer(new Boat(), $beachA, $beachB);
    $transfer->process();
} catch (Exception $e) {
    die ($e->getMessage());
}

// Output logs
echo \Avkdev\Logger::getInstance();