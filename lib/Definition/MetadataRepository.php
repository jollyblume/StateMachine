<?php

namespace JBJ\Workflow\StateMachine\Definition;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\Collection\GraphCollectionTrait;
use JBJ\Workflow\Traits\CreateIdTrait;

class MetadataRepository implements ArrayCollectionInterface
{
    use GraphCollectionTrait {
        getName as protected;
    }
    use CreateIdTrait;

    public function __construct(PropertyAccessorInterface $propertyAccessor = null, array $carts = [], string $repositoryName = '')
    {
        $name = $repositoryName;
        $rules = [
            'name' => [
                'cartName',
                'isDisabled' => false,
                'isValid' => true,
            ],
            'parent' => [
                'parentRepository',
                'isDisabled' => false,
                'isValid' => true,
            ],
        ];
        $this->initializeTrait($name, $carts, $rules, $propertyAccessor);
    }

    public function getRepositoryName()
    {
        return $this->getName();
    }
}
