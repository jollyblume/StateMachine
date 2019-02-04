<?php

namespace JBJ\Workflow\StateMachine;

/**
 * Memory
 *
 * A state machine memory supporting deterministic and moore machines
 *
 * No other memory devices are needed for a mealy machine, depending on how I
 * implement the state machine output combinational logic.
 *
 * Memory devices can be extended to provide persistence or other logic.
 *
 * Persistence is not a standard state machine feature. However, there are use
 * cases where a state machine must be in it's state during the previous request
 * (for instance). In this case, the memory device could be stored in a user's
 * session.
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
