<?php
error_reporting(-1);

/**
 * Основной класс паттерна "Абстрактная фабрика"
 */
interface IRaceFactory {
    public function getSoldier($name);
    public function getWorker();
    public function getBuild();
}

interface ISoldier {
    public function attack();
    public function defend();
    public function magic();
}

interface IWorker {
    public function workSpeed();
}

interface IBuild {
    public function report($speed);
}

class HumanFactory implements IRaceFactory {
    public function getSoldier($name) {
        switch ($name) {
            case 'footman': return new Footman();
            case 'knight': return new Knight();
            case 'rifleman': return new Rifleman();
        }
    }

    public function getWorker() {
        return new HumanWorker();
    }

    public function getBuild() {
        return new HumanBuild();
    }
}

class OrcFactory implements IRaceFactory {
    public function getSoldier($name) {
        switch ($name) {
            case 'grunt': return new Grunt();
            case 'troll': return new Troll();
            case 'tauren': return new Tauren();
        }
    }

    public function getWorker() {
        return new OrcWorker();
    }

    public function getBuild() {
        return new OrcBuild();
    }
}

/* Human units */
class Footman implements ISoldier {
    public function attack() {}
    public function defend() {}
    public function magic() {}
}
class Knight implements ISoldier {
    public function attack() {}
    public function defend() {}
    public function magic() {}
}
class Rifleman implements ISoldier {
    public function attack() {}
    public function defend() {}
    public function magic() {}
}
class HumanWorker implements IWorker {
    public function workSpeed() {
        return 5;
    }
}
class HumanBuild implements IBuild {
    public function report($speed) {
        return 'Здание будет построено в течении ' . $speed . ' единиц времени';
    }
}

/* Orcish units */
class Grunt implements ISoldier {
    public function attack() {}
    public function defend() {}
    public function magic() {}
}
class Troll implements ISoldier {
    public function attack() {}
    public function defend() {}
    public function magic() {}
}
class Tauren implements ISoldier {
    public function attack() {}
    public function defend() {}
    public function magic() {}
}
class OrcWorker implements IWorker {
    public function workSpeed() {
        return 7;
    }
}
class OrcBuild implements IBuild {
    public function report($speed) {}
}

/* CLIENT */
function createBuild($race, $workersCount = 1) {
    $factory = null;

    switch ($race) {
        case 'human': $factory = new HumanFactory(); break;
        case 'orc': $factory = new OrcFactory(); break;
    }

    $speed = 0;
    for ($i = 0; $i < $workersCount; ++$i) {
        $speed += $factory->getWorker()->workSpeed();
    }

    return $factory->getBuild()->report($speed);
}

echo createBuild('human', 3);
