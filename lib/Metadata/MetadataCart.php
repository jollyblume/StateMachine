<?php

namespace JBJ\Workflow\StateMachine\Metadata;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\Collection\GraphCollectionTrait;
use JBJ\Workflow\Traits\CreateIdTrait;

class MetadataCart implements ArrayCollectionInterface
{
    use GraphCollectionTrait {
        getName as protected;
    }
    use CreateIdTrait;

    public function __construct(PropertyAccessorInterface $propertyAccessor = null, array $bags = [], string $cartName = '')
    {
        $name = $this->createId($cartName);
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

    public function geCartName()
    {
        return $this->getName();
    }
}
