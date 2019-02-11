<?php

namespace JBJ\Workflow\StateMachine;

use Symfony\Component\Workflow\Definition;
//use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * forked from symfony/workflow
 *
 * bc:  no name param in __construct. fix this later
 *      all metadata, including name, comes from a definition.
 */
class Workflow implements WorkflowInterface {
    private $dispatcher;
    private $propertyAccessor;

    public function __construct(Definition $definition, EventDispatcherInterface $dispatcher, PropertyAccessorInterface $propertyAccessor = null)
    {
        $this->dispatcher = $dispatcher;
        $propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();
    }

    protected function 
}
