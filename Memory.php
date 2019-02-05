<?php

namespace JBJ\Workflow\StateMachine;

/**
 * Memory
 *
 * A state machine memory device.
 *
 * A memory device stores internal properties for a state machine and initiates
 * next state logic when an input signal is also a clock signal.
 *  - current state
 *  - input signal buffer
 *  - state machine
 *
 * Regardless, persistence is expected to be an edge-case for state machines.
 */
class Memory implements MemoryInterface
{
    private $state;

    public function getState()
    {
        return $this->state;
    }

    public function setState(string $newState)
    {
        $this->state = $newState;
    }

    public function __toString()
    {
        $state = $this->state;
        if (!$state) {
            $state = 'unknown-state';
        }
        return $state;
    }
}
