<?php

namespace JBJ\Workflow\StateMachine;

/**
 * Memory
 *
 * A state machine memory device.
 *
 * A memory device stores internal properties for a state machine and initiates
 * next state logic when an input signal is also a clock signal via
 * symfony/workflow::WorkflowInterface::apply().
 *  - current state
 *  - input signal buffer
 *
 * This is not meant to feature any persistence. It is a run-time only lifespan.
 */
class Memory
{
    //todo implementation
}
