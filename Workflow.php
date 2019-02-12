<?php

namespace JBJ\Workflow\StateMachine;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class Workflow {
    private $dispatcher;
    private $propertyAccessor;

    public function __construct(DefinitionInterface $definition, EventDispatcherInterface $dispatcher, PropertyAccessorInterface $propertyAccessor = null)
    {
        $this->dispatcher = $dispatcher;
        $propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();
    }

    protected function
}
