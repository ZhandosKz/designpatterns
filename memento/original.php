<?php

/**
 * Class Originator
 * @link https://en.wikipedia.org/wiki/Memento_pattern
 */
class Originator
{
    private $state;

    public function setState($value)
    {
        $this->state = $value;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getMemento()
    {
        return new Memento($this->state);
    }

    public function setMemento(Memento $memento)
    {
        $this->state = $memento->getState();
    }
}

class Memento
{
    private $state;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}

$originator = new Originator();

$originator->setState(10);
$memento = $originator->getMemento();
echo $originator->getState() . PHP_EOL;
$originator->setState(20);
$originator->setMemento($memento);
echo $originator->getState();
