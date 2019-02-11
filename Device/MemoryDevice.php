<?php

namespace JBJ\Workflow\StateMachine\Device;

use Symfony\Workflow\WorkflowInterface;

/**
 * MemoryDevice
 *
 * A collection of input signals.
 */
class InputDevice extends Device
{
    private $output;

    public function __construct(array $elements = [], string $name = '')
    {
        parent::__construct($elements, $name);
    }

    public function getOutput()
    {
        // $output is null when no output set.
        //
    }
}
