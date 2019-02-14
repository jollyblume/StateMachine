<?php

namespace JBJ\Workflow\StateMachine\Metadata;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\Collection\GraphCollectionTrait;

class MetadataBag implements ArrayCollectionInterface
{
    use GraphCollectionTrait {
        getName as protected;
        getParent as protected;
        setParent as protected;
        getPropertyAccessor as protected;
    }

    public function __construct(array $items = [], string $bagName = '', PropertyAccessorInterface $propertyAccessor = null)
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
