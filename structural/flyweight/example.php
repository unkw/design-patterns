<?php
error_reporting(-1);

/**
 * "FlyweightFactory"
 */
class SoldierFactory {
    private $soldiers = array();

    public function getSoldier($country) {
        if (empty($this->soldiers[$country])) {
            switch ($country) {
                case 'russia': $this->soldiers[$country] = new RussianSoldier(); break;
            }
        }

        return $this->soldiers[$country];
    }
}

/**
 * "Flyweight"
 */
abstract class Soldier {
    //внутреннее состояние
    protected $skin;
    protected $rifle;
    //внешение состояние
    protected $healthLevel;

    public abstract function display($coords);
    public abstract function setHealthLevel($percent);
}

/**
 * "ConcreteFlyweight"
 */
class RussianSoldier extends Soldier {
    public function __construct() {
        $this->skin = 'красной форме';
        $this->rifle = 'AK-47';
    }

    public function display($coords) {
        echo 'Русский солдат (' . $this->healthLevel . '%) в ' . $this->skin . ' отображен с ' . $this->rifle . ' по координатам ' . implode('x', $coords). '<br>';
    }

    public function setHealthLevel($percent) {
        $this->healthLevel = $percent;
    }
}

/**
 * "Cleint"
 */
$soldiers = array(
    array('country' => 'russia', 'coords' => array('x' => 15, 'y' => 10), 'healthLevel' => 100),
    array('country' => 'russia', 'coords' => array('x' => 15, 'y' => 15), 'healthLevel' => 95),
    array('country' => 'russia', 'coords' => array('x' => 15, 'y' => 25), 'healthLevel' => 90),
    array('country' => 'russia', 'coords' => array('x' => 15, 'y' => 30), 'healthLevel' => 100),
    array('country' => 'russia', 'coords' => array('x' => 15, 'y' => 35), 'healthLevel' => 100),
);
$factory = new SoldierFactory();

foreach ($soldiers as $data) {
    $soldier = $factory->getSoldier($data['country']);

    $soldier->setHealthLevel($data['healthLevel']);
    $soldier->display($data['coords']);
}