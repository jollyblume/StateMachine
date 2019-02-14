<?php

namespace JBJ\Workflow\StateMachine\Definition;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\Collection\GraphCollectionTrait;

class MetadataCart implements ArrayCollectionInterface
{
    use GraphCollectionTrait {
        getName as protected;
        getParent as protected;
        setParent as protected;
        getPropertyAccessor as protected;
    }

    public function __construct(array $bags = [], string $cartName = '', PropertyAccessorInterface $propertyAccessor = null)
    {
        $rules = [
            'name' => [
                'bagName',
                'isDisabled' => false,
                'isValid' => true,
            ],
            'parent' => [
                'parentCart',
                'isDisabled' => false,
                'isValid' => true,
            ],
        ];
        $this->initializeTrait($cartName, $bags, $rules, $propertyAccessor);
    }

    public function getCartName()
    {
        return $this->getName();
    }

    public function getParentRepository()
    {
        return $this->getParent();
    }

    public function setParentRepository($parentRepository)
    {
        $this->setParent($parentRepository);
    }
}
