<?php

namespace JBJ\Workflow\StateMachine\Device;

use Symfony\Workflow\WorkflowInterface;

/**
 * MemoryDevice
 *
 * An internal implementation detail used by the mediator and the workflow.
 *
 * A collection of input signals and current state for a state machine.
 *
 * For a state machine, the symfony/workflow::$subject method parameter will often
 * be an array of current input signals and new input signals. The $transition
 * parameter will be the current state.
 *
 * Before the mediator takes any action on a state machine, it will apply a current
 * state to the machine, before applying new input signals and possibly initiating
 * next state combinational logic.
 *
 * This should allow concrete state machines to be used for multiple purposes
 * within an application.
 */
class MemoryDevice extends Device
{
    public function __construct(array $elements = [], string $name = '')
    {
        parent::__construct($elements, $name);
    }
}
