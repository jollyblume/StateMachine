<?php

namespace JBJ\Workflow\StateMachine\Device;

use Symfony\Workflow\WorkflowInterface;
use JBJ\ComposedCollections\Collection\ArrayCollectionInterface;
use JBJ\ComposedCollections\Collection\CollectionTrait;
use JBJ\Workflow\StateMachine\Traits\CreateIdTrait;

abstract class Device implements ArrayCollectionInterface
{
    use CollectionTrait, CreateIdTrait;

    private $name;
    private $parent;

    public function __construct(array $elements = [], string $name = '')
    {
        $this->name = $this->createId($name);
        if (!empty($elements)) {
            $this->setChildren($elements);
        }
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
        return $this->parent;
    }
}
