<?php

namespace JBJ\Workflow\StateMachine\Device;

/**
 * OutputDevice
 *
 * Provided to an application via the mediator.
 *
 * Output devces contain output combinational login, using a workflow current
 * state and possibly a set of input signals.
 *
 * This is useful to both a workflow and a state machine implementation.
 *
 * The workflow can have a concept of general state (or state categorized by a
 * marking(s)). A workflow implementation will not have the concept of input
 * signals.This type of categorization inside a workflow would likely be executed
 * by a state machine, but can be optimized into an implementation specific code.
 *
 * An output device is a read-only collection. The entire collection is the output
 * for the current state/input signals combination. When the state changes, so
 * will the output array.
 *
 * For example: you could output a list or menu that will be specific to a given
 * state.
 *
 * Contextual application output is a primary function of an output device.
 */
class OutputDevice extends Device
{
    public function __construct(WorkflowInterface $workflow)
    {
        parent::__construct($workflow, []);
    }

    public function get($key)
    {
        $this->computeOutput();
        $value = $this->getChildren()[$key];
        return $value;
    }

    protected function computeOutput()
    {
        $this->clear();
        //todo need to cache result? would need invalidation when inputs and
        //      state changes. I don't think regenerating output for each get
        //      is very optimized, but may not be much computation load.
        //todo get state and maybe input from state machine.
        //todo use input to create the final output collection.
        //todo set ouput into composed children collection.
    }

    private function throwReadOnlyException(string $msg) {
        throw new \JBJ\Workflow\StateMachine\Exception\FixMeException($msg);
    }

    public function set($key, $value)
    {
        $this->throwReadOnlyException('Unable to set value. This collection is read only');
    }

    public function add($element)
    {
        $this->throwReadOnlyException('Unable to add value. This collection is read only');
    }

    public function remove($key)
    {
        $this->throwReadOnlyException('Unable to remove key. This collection is read only');
    }

    public function removeElement($element)
    {
        $this->throwReadOnlyException('Unable to remove value. This collection is read only');
    }
}
