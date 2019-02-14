<?php

namespace JBJ\Workflow\StateMachine\Definition;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\Collection\GraphCollectionTrait;

class MetadataBag implements ArrayCollectionInterface
{
    use GraphCollectionTrait {
        getName as protected;
        getParent as protected;
        setParent as protected;
        getDispatcher as protected;
        getPropertyAccessor as protected;
    }

    public function __construct(PropertyAccessorInterface $propertyAccessor = null, array $items = [], string $bagName = '')
    {
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
        $this->initializeTrait($bagName, $items, $rules, $propertyAccessor);
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
