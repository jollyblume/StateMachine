<?php

namespace JBJ\Workflow\StateMachine;

use Symfony\Component\Workflow\Definition;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use JBJ\Workflow\Workflow;

/**
 */
class StateMachine extends Workflow {
    public function __construct(Definition $definition, EventDispatcherInterface $dispatcher = null, PropertyAccessorInterface $propertyAccessor = null)
    {
        parent::__construct($definition, $dispatcher, $propertyAccessor);

        //todo initialize state machine from metadata (inputs, outputs, etc.)
    }

    public function getState()
    {
        //todo implement memory. memory should use marking store shim from parent
        //todo persisting fsm state may be troublesome
        //   - fsm state is event driven. in addition to current state, all input
        //     signal states will need to be persisted. should be fine: marking
        //     stores persist arrays. array of placces for a workflow, but for
        //     fsm: [
        //              'currentState',
        //              'signal-count' => <number-of-input-signals,
        //              'signal-1' => <value>,
        //              'signal-2' => <value>,
        //                ...etc...
        //          ];
        //   -
        // $state = $this->memory->getState();
        // if (!$state) {
        //     $state = $this->definition->getInitialPlace();
        //     $this->memory->setState($state);
        // }
        // return $state;
        return $this->getPl
    }

    public function getName()
    {
        return $this->name;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
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
