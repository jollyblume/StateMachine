<?php

namespace JBJ\Workflow\StateMachine;

use Symfony\Component\Workflow\Definition;
use JBJ\Workflow\StateMachine\MemoryInterface;
use JBJ\Workflow\StateMachine\Memory;
use Ramsey\Uuid\Uuid;

/**
 */
class StateMachine {
    private $definition;
    private $memory;
    private $name;
    private $inputSignals;

    public function __construct(Definition $definition, MemoryInterface $memory = null, string $name = '')
    {
        $this->definition = $definition;
        if (null === $memory) {
            $memory = new Memory();
        }
        $this->memory = $memory;
        if (empty($name)) {
            $name = Uuid::uuid4();
        }
        $this->name = $name;

        //todo initialize input signals
    }

    public function getState()
    {
        $state = $this->memory->getState();
        if (!$state) {
            $state = $this->definition->getInitialPlace();
            $this->memory->setState($state);
        }
        return $state;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDefinition()
    {
        return $this->definition;
    }

    public function can($newState)
    {
        //todo
    }

    public function buildTransitionBlockerList(string $newState): TransitionBlockerList
    {
        //todo
    }

    public function getEnabledTransitions()
    {

    }

    public function apply()
    {
        //todo
    }
}
