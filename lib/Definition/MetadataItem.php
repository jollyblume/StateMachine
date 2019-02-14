<?php

namespace JBJ\Workflow\StateMachine\Definition;

use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\Collection\CollectionTrait;
use JBJ\Workflow\Traits\ElementNameTrait;
use JBJ\Workflow\Traits\ElementParentTrait;

class MetadataItem implements ArrayCollectionInterface
{
    use CollectionTrait;
    use ElementNameTrait{
        getName as protected;
    }
    use ElementParentTrait{
        getParent as protected;
        setParent as protected;
    }

    public function __construct(string $itemName, array $metadata = [])
    {
        $this->setName($itemName);
        $this->saveChildren($metadata);
    }

    public function getItemName()
    {
        return $this->getName();
    }

    public function getParentBag()
    {
        return $this->getParent();
    }

    public function setParentBag($parentBag)
    {
        $this->setParent($parentBag);
    }
}
