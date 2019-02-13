<?php

namespace JBJ\Workflow\StateMachine\Definition;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\Collection\GraphCollectionTrait;
use JBJ\Workflow\Traits\CreateIdTrait;

class MetadataCart implements ArrayCollectionInterface
{
    use GraphCollectionTrait {
        getName as protected;
        getParent as protected;
        setParent as protected;
    }
    use CreateIdTrait;

    public function __construct(PropertyAccessorInterface $propertyAccessor = null, array $bags = [], string $cartName = '')
    {
        $name = $cartName;
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
        $this->initializeTrait($name, $bags, $rules, $propertyAccessor);
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
