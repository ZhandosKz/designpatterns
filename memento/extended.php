<?php

/**
 * Class BaseOriginator
 * @link https://en.wikipedia.org/wiki/Memento_pattern
 */
abstract class BaseOriginator
{
    public function getMemento()
    {
        return new Memento($this);
    }
}
class Originator extends BaseOriginator
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
}

interface MementoInterface
{
    public function restore();
}
abstract class BaseMemento implements MementoInterface
{
    protected $originator;
    public function __construct($originator)
    {
        $this->originator = $originator;
        $this->saveState();
    }
    abstract protected function saveState();
}

/**
 * Class Memento
 * @property Originator $originator
 */
class Memento extends BaseMemento
{
    private $state;

    protected function saveState()
    {
        $this->state = $this->originator->getState();
    }

    public function restore()
    {
        $this->originator->setState($this->state);
    }
}

/**
 * @var MementoInterface[] $states
 */
$states = [];
$originator = new Originator();

// #1 snapshot
$originator->setState(3);
$states[] = $originator->getMemento();

// #2 snapshot
$originator->setState(5);
$states[] = $originator->getMemento();

// #3 snapshot
$originator->setState(7);
$states[] = $originator->getMemento();

$originator->setState(null);

// Restore #1 snapshot
$states[0]->restore();
echo $originator->getState() . PHP_EOL;

// Restore #2 snapshot
$states[1]->restore();
echo $originator->getState() . PHP_EOL;

// Restore #3 snapshot
$states[2]->restore();
echo $originator->getState() . PHP_EOL;