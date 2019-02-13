<?php

namespace JBJ\Workflow\StateMachine\Metadata;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\Collection\GraphCollectionTrait;
use JBJ\Workflow\Traits\CreateIdTrait;

class MetadataBag implements ArrayCollectionInterface
{
    use GraphCollectionTrait {
        getName as protected;
        getParent as protected;
        setParent as protected;
    }
    use CreateIdTrait;

    public function __construct(PropertyAccessorInterface $propertyAccessor = null, array $items = [], string $bagName = '')
    {
        $name = $this->createId($bagName);
        $rules = [
            'name' => [
                'itemName',
                'isDisabled' => false,
                'isValid' => true,
            ],
            'parent' => [
                'parentBag',
                'isDisabled' => false,
                'isValid' => true,
            ],
        ];
        $this->initializeTrait($name, $items, $rules, $propertyAccessor);
    }

    public function getBagName()
    {
        return $this->getName();
    }

    public function getParentCart()
    {
        return $this->getParent();
    }

    public function setParentCart($parentCart)
    {
        $this->setParent($parentCart);
    }
}
