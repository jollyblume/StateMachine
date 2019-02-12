<?php

namespace JBJ\Workflow\StateMachine;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class Workflow
{
    private $definition;
    private $dispatcher;
    private $propertyAccessor;

    public function __construct(DefinitionInterface $definition)
    {
        $this->definition = $definition;
    }

    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    public function setDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function setPropertyAccessor(PropertyAccessorInterface $propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

    public function getPropertyAccessor()
    {
        return $this->propertyAccessor;
    }
}
