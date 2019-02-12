<?php

namespace JBJ\Workflow\StateMachine\MetadataStore;

use JBJ\ComposedCollections\Collection\ArrayCollectionInterface;
use JBJ\ComposedCollections\Collection\CollectionTrait;
use JBJ\ComposedCollections\Traits\ElementNameTrait;
use JBJ\ComposedCollections\Traits\ElementParentTrait;

class MetadataCollection implements ArrayCollectionInterface
{
    use CollectionTrait, ElementNameTrait, ElementParentTrait;

    public function __construct(string $name, array $elements = [])
    {
        $this->setName($name);
        if (!empty($elements)) {
            $this->setChildren($elements);
        }
    }

    protected function setName(string $name)
    {
        $this->name = $name;
    }
}
